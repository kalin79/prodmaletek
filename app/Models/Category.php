<?php


namespace App\Models;


use App\Http\Filters\QueryFilter;
use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Audit;
    use QueryFilter;
    protected $table = 'categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'parent_id', 'active', 'position', 'poster','description','icon','sub_title','special_occasion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'parent_id' => 'integer',
        'active' => 'boolean',
        'poster' => 'string',
        'icon' => 'string',
        'special_occasion' =>'string'
    ];

    public static function storeValidation($request)
    {
        return [
            'name' => 'required',
            'parent_id' => 'numeric|required',
            'images' => 'image|mimes:jpeg,png,jpg|max:1024'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'name' => 'required',
            'parent_id' => 'numeric|required',
            'images' => 'image|mimes:jpeg,png,jpg|max:1024',
        ];
    }

    public static function attributesValidation()
    {
        return [
            'name' => 'name',
            'parent_id' => 'parent_id',

        ];
    }

    public static function finterAndPaginate($q=null, $parent=null)
    {
        $categories = Category::orderBy('position', "asc")
            ->orderBy('name','asc')
            ->withCount('subCategories')
            ->withCount('banners');
        if ($parent) {
            $categories->where('parent_id', $parent);
        } else {
            $categories->where('parent_id', 0);
        }
        return $categories->paginate("10");
    }

    public function scopeActivos($query)
    {
        return $query->where('active', 1);
    }

    /*
     * RELATIONS
     * */

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function banners()
    {
        return $this->hasMany(BannerCategory::class, 'category_id');
    }

    public function updateImages($images)
    {
        if ($images) {
            $destinationPath = public_path('/images/categorias/'.$this->id);
            if(!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $file = $images;
            $imagename = $this->id . "-" . time() . '.' . $images->getClientOriginalExtension();
            $file->move($destinationPath, $imagename);
            $this->update(['poster'=>$imagename]);
        }
    }
    public function updateIcon($images)
    {
        if ($images) {
            $destinationPath = public_path('/images/categorias/'.$this->id);
            if(!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $file = $images;
            $imagename = $this->id . "-mb-" . time() . '.' . $images->getClientOriginalExtension();
            $file->move($destinationPath, $imagename);
            $this->update(['icon'=>$imagename]);
        }
    }

    public function getImages()
    {
        $baseUrl = Storage::disk('categories')->url();
        $images[] = $this->poster;
        return [
            'url' => $baseUrl,
            'data' => $images
        ];
    }
}

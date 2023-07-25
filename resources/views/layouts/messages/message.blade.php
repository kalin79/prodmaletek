
@if(session()->has('message'))

<div class="alert  alert-success alert-wth-icon alert-dismissible fade show" role="alert">
    <span class="alert-icon-wrap"><i class="zmdi zmdi-check-circle"></i></span> <strong>Éxito!</strong> {{ session()->get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    
</div>
@elseif(session()->has('error_message'))
    <div class="alert alert alert-border-bottom alert-danger bg-gradient alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-info pr10"></i>
        <strong>Alerta!</strong> 
        <a href="#" class="alert-link">{{ session()->get('error_message') }}</a>
    </div>
@elseif($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-sm alert-border-left alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-warning pr10"></i>
            <strong>Error!</strong> 
            <a href="#" class="alert-link">{{ $error }}</a>
        </div>
    @endforeach
@endif
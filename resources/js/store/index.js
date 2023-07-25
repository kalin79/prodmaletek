import { createStore } from 'vuex';

import product from './modules/product';
import category from './modules/category';

const store = createStore({

     modules: {
          product,
          category,
     }

});

export default store;
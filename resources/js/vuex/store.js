import Vue from 'vue'
import Vuex from 'vuex'

import Todos from './modules/todos/todos'

Vue.use(Vuex)


const store = new Vuex.Store({
    modules: {
        todos: Todos
    }
})

export default store 
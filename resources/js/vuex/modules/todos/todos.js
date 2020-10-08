import axios from 'axios'

export default {
    state: {
        tasks: {},
    },

    mutations: {
        LOAD_TASKS(state, tasks) {
            state.tasks = tasks;
        },
    },

    actions: {
        createTask(context, data) {
            return new Promise((resolve, reject) => {
                axios.post('http://localhost:3000/tasks', data)
                    .then(tasks => {
                        resolve(response => resolve(response))
                    })
                    .catch(error => reject(error))
                    .finally(() => { })
            })
        },

        loadTasks(context) {
            return new Promise((resolve, reject) => {
                axios.get('http://localhost:3000/tasks')
                    .then(tasks => {
                        resolve()
                        context.commit('LOAD_TASKS', tasks)
                    })
                    .catch(error => reject(error))
                    .finally(() => { })
            })
        },

        updateTask(context, data) {
            return new Promise((resolve, reject) => {
                axios.put(`http://localhost:3000/tasks/${data.id}`, data)
                    .then(response => resolve(response))
                    .catch(error => {
                        reject(error)
                    })
                    .finally(() => { })
            })
        },

        destroyTask(context, id) {
            return new Promise((resolve, reject) => {
                axios.delete(`http://localhost:3000/tasks/${id}`)
                    .then(() => resolve())
                    .catch(error => {
                        reject(error)
                    })
                    .finally(() => { })
            })
        }
    },

    getters: {

    }
}
/* Include CSRF token on all ajax requests done through vue.js */
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
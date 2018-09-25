import Vue from 'vue'
import Router from 'vue-router'
// import home from './components/Home'
import blog from './components/blog'
import about from './components/about'
import contact from './components/contact'

Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/blog',
            name: 'blog',
            component: blog
        },
        // {
        //     path: '/',
        //     name: 'home',
        //     component: home
        // },
        {
            path: '/about',
            name: 'about',
            component: about
        },
        {
            path: '/contact',
            name: 'contact',
            component: contact
        }
    ]
})
import VueRouter from 'vue-router';


let routes = [
    {
        path: '/dashboard',
        component: require('./views/dashboard').default
    },
    {
        path: '/users',
        component: require('./views/users').default
    },
    {
        path: '/profile',
        component: require('./views/profile').default
    },
    {
        path: '/settings',
        component: require('./views/settings').default
    },

];


export default new VueRouter({
    base: '/admin/',
    // mode: 'history',
    routes,
    linkActiveClass: 'active'
});

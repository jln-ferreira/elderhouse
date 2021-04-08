import VueRouter from 'vue-router';


let routes = [
    {
        path: '/dashboard',
        component: require('./views/dashboard').default
    },
    {
        path: '/clients',
        component: require('./views/clients/index').default
    },
    {
        path: '/clients/:id',
        component: require('./views/clients/show').default
    },
    {
        path: '/newclient',
        component: require('./views/clients/create').default
    },
    {
        path: '/users',
        component: require('./views/users/users').default
    },
    {
        path: '/profile',
        component: require('./views/profile/profile').default
    },
    {
        path: '/products',
        component: require('./views/products/products').default
    },
    {
        path: '/inventories',
        component: require('./views/inventories/inventories').default
    },
    {
        path: '/settings',
        component: require('./views/settings/settings').default
    },

];


export default new VueRouter({
    base: '/admin/',
    // mode: 'history',
    routes,
    linkActiveClass: 'active'
});

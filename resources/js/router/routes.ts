export default [
    { path: '/', redirect: '/app' },
    {
        path: '/app',
        component: () => import('@/pages/Home.vue'),
        name: 'main',
        meta: {
            guard: 'auth',
            breadcrumbs: [
                { title: 'Bosh sahifa', to: '/app' , disabled: true }
            ]
        },
        redirect: {
            name: 'index'
        },
        children: [
            {
                path: 'index',
                name: 'index',
                component: () => import('@/pages/Index.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Hodimlar', to: '/app' , disabled: true },
                    ]
                }
            },
            {
                path: 'employes',
                name: 'employes',
                component: () => import('@/pages/Employes.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Hodimlar', to: '/app/employes' , disabled: true },
                    ]
                }
            },
            {
                path: 'positions',
                name: 'positions',
                component: () => import('@/pages/Positions.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Lavozimlar', to: '/app/positions' , disabled: true }
                    ]
                }
            },
            {
                path: 'organizations',
                name: 'organizations',
                component: () => import('@/pages/Organizations.vue'),
                meta: {
                    breadcrumbs: [
                        { title: "Bo'linmalar", to: '/app/organizations' , disabled: true }
                    ]
                }
            },
            {
                path: 'employe/:id',
                name: 'employe',
                component: () => import('@/pages/Employe.vue'),
                props: true,
                meta: {
                    breadcrumbs: [
                        { title: "Hodimlar", to: '/app/employes' , disabled: false }
                    ]
                }
            },
            {
                path: 'products',
                name: 'products',
                component: () => import('@/pages/Products.vue'),
                props: true,
                meta: {
                    breadcrumbs: [
                        { title: "Mahsulotlar", to: '/app/products' , disabled: true }
                    ]
                }
            },
        ]
    },


    {
        path: '/login',
        name: 'login',
        meta: {
            guard: 'guest',
        },
        component: () => import('@/pages/Login.vue'),
    },
]
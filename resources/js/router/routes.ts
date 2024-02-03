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
            name: 'employes'
        },
        children: [
            {
                path: 'index',
                name: 'index',
                component: () => import('@/pages/Main/Index.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Hodimlar', to: '/app' , disabled: true },
                    ]
                }
            },
            {
                path: 'users',
                name: 'users',
                component: () => import('@/pages/User/Users.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Hodimlar', to: '/app' , disabled: true },
                    ]
                }
            },
            {
                path: 'employes',
                name: 'employes',
                component: () => import('@/pages/Employes/Employes.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Hodimlar', to: '/app/employes' , disabled: true },
                    ]
                }
            },
            {
                path: 'positions',
                name: 'positions',
                component: () => import('@/pages/Position/Positions.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Lavozimlar', to: '/app/positions' , disabled: true }
                    ]
                }
            },
            {
                path: 'report',
                name: 'report',
                component: () => import('@/pages/Report/Reports.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Lavozimlar', to: '/app/report' , disabled: true }
                    ]
                }
            },
            

            {
                path: 'organizations',
                name: 'organizations',
                component: () => import('@/pages/Organization/Organizations.vue'),
                meta: {
                    breadcrumbs: [
                        { title: "Bo'linmalar", to: '/app/organizations' , disabled: true }
                    ]
                }
            },
            {
                path: 'employe/:id',
                name: 'employe',
                component: () => import('@/pages/Employe/Employe.vue'),
                props: true,
                meta: {
                    breadcrumbs: [
                        { title: "Xodimlar", to: '/app/employes' , disabled: false }
                    ]
                }
            },
            {
                path: 'products',
                name: 'products',
                component: () => import('@/pages/Product/Products.vue'),
                props: true,
                meta: {
                    breadcrumbs: [
                        { title: "Mahsulotlar", to: '/app/products' , disabled: true }
                    ]
                }
            },
            {
                path: 'maindocuments',
                name: 'maindocuments',
                component: () => import('@/pages/MainDocument/MainDocuments.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Normaviy hujjatlar', to: '/app' , disabled: true },
                    ]
                }
            },
            {
                path: 'working_conditions',
                name: 'workingconditions',
                component: () => import('@/pages/WorkingCondition/WorkingConditions.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Mehnat sharoitlari', to: '/app' , disabled: true },
                    ]
                }
            },
            {
                path: 'specialproduct',
                name: 'specialproduct',
                component: () => import('@/pages/SpecialProduct/SpecialProducts.vue'),
                meta: {
                    breadcrumbs: [
                        { title: 'Mehnat sharoitlari', to: '/app' , disabled: true },
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
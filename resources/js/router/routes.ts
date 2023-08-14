export default [
    {
        path: '/',
        component: () => import('@/pages/Home.vue'),
        name: 'Bosh sahifa',
        meta: {
            breadcrumbs: [
                { title: 'Bosh sahifa', to: '/' , disabled: true }
            ]
        }
    },

    {
        path: '/settings',
        component: () => import('@/pages/Settings.vue'),
        meta: {
            breadcrumbs: [
                { title: 'Bosh sahifa', to: '/' , disabled: true },
            ]
        }
    },
    {
        path: '/positions',
        component: () => import('@/pages/Positions.vue'),
        meta: {
            breadcrumbs: [
                { title: 'Lavozimlar', to: '/positions' , disabled: true }
            ]
        }
    },
    {
        path: '/organizations',
        component: () => import('@/pages/Organizations.vue'),
        meta: {
            breadcrumbs: [
                { title: "Bo'linmalar", to: '/organizations' , disabled: true }
            ]
        }
    },
    {
        path: '/fuel',
        component: () => import('@/pages/Organizations.vue'),
        meta: {
            breadcrumbs: [
                { title: "Bo'linmalar", to: '/organizations' , disabled: true }
            ]
        }
    },
    {
        path: '/employe/:id',
        name: 'employe',
        component: () => import('@/pages/Employe.vue'),
        props: true,
        meta: {
            breadcrumbs: [
                { title: "Bosh sahifa", to: '/' , disabled: false }
            ]
        }
    },
    {
        path: '/products',
        name: 'products',
        component: () => import('@/pages/Products.vue'),
        props: true,
        meta: {
            breadcrumbs: [
                { title: "Mahsulotlar", to: '/products' , disabled: true }
            ]
        }
    },
    {
        path: '/login',
        component: () => import('@/pages/Login.vue'),
    },
]
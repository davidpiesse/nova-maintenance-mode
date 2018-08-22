Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'nova-maintenance-mode',
            path: '/nova-maintenance-mode',
            component: require('./components/Tool'),
        },
    ])
})

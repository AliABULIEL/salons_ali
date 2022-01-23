Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'calendar',
      path: '/calendar',
      component: require('./components/Tool'),
    },
  ])
})

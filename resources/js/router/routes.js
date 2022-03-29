function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', redirect: { name: 'login' } },

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },

  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.password' } },
      { path: 'profile', name: 'settings.password', component: page('settings/password.vue') },
      { path: 'profile/s', name: '', component: page('settings/s.vue') }
    ]
  },
{path: '/prueva', name:'prueva', component: page('settings/s.vue') },

  {
    path: '/admin',component: page('admin/index.vue'),
    children: [
      { path: '', redirect: { name: 'admin.dashboard' } },
      { path: 'dashboard', name: 'admin.dashboard', component: page('admin/dashboard.vue') },
      { path: 'tramites', name: 'admin.tramites', component: page('admin/tramites.vue') },
      { path: 'tramite/:id', name: 'admin.tramite', component: page('admin/tramite.vue') },
      { path: 'personas-usuarios', name: 'admin.usuarios', component: page('admin/usuarios.vue') },

    ]
  },
  
  {
    path: '/alumno',component: page('alumno/index.vue'),
    children: [
      { path: '', redirect: { name: 'alumno.dashboard' } },
      { path: 'dashboard', name: 'alumno.dashboard', component: page('alumno/dashboard.vue') },
      { path: 'tramite/:id', name: 'alumno.tramite', component: page('alumno/tramite.vue') },
    ]
  },


  //hitler gilllllllllllllll
  { path: '*', component: page('errors/404.vue') },
]

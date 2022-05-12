function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  
  { path: '/', redirect: { name: 'login' } },

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  //{ path: '/pdf', name: 'pdf', component: page('app/Http/Controllers/PdfController.php') },

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



  {
    
    path: '/admin',component: page('admin/index.vue' ) ,
    children: [
      { path: '', redirect: { name: 'admin.dashboard' } },
      { path: 'dashboard', name: 'admin.dashboard', component: page('admin/dashboard.vue') },
      { path: 'tramites', name: 'admin.tramites', component: page('admin/tramites.vue') },
      { path: 'tramite/:id', name: 'admin.tramite', component: page('admin/tramite.vue') },
      { path: 'personas-usuarios', name: 'admin.usuarios', component: page('admin/usuarios.vue') },
      { path: 'tiny', name: 'admin.tiny', component: page('admin/tiny.vue') },

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

  {
    path: '/secretaria-general',component: page('secretariaGeneral/index.vue'),
    children: [
      { path: '', redirect: { name: 'secretaria_general.dashboard' } },
      { path: 'dashboard', name: 'secretaria_general.dashboard', component: page('secretariaGeneral/dashboard.vue') },
      { path: 'expedientes-por-agendar', name: 'sg.expedientes', component: page('secretariaGeneral/expedientes.vue') },
      { path: 'expedientes-agendados', name: 'sg.agendados', component: page('secretariaGeneral/agendados.vue') },
      { path: 'expedientes-aprobados', name: 'sg.aprobados', component: page('secretariaGeneral/aprobados.vue') },
      { path: 'datos-internos', name: 'sg.resueltos', component: page('secretariaGeneral/resueltos.vue') },
      { path: 'control-sticker', name: 'sg.sticker', component: page('secretariaGeneral/sticker.vue') },
      { path: 'para-sunedu', name: 'sg.sunedu', component: page('secretariaGeneral/sunedu.vue') },
      { path: 'tramite/:id', name: 'sg.tramite', component: page('secretariaGeneral/tramite.vue') },
      { path: 'revisar/tramite/:tramite', name: 'sg.revisar', component: page('secretariaGeneral/revisar.vue') }
 

    ]
  },
  {
    path: '/secretaria-facultad',
    component: page('secretariaFacultad/index.vue'),
    
    children: [
      { path: '', redirect: { name: 'sf.dashboard' } },
      { path: 'dashboard', name: 'sf.dashboard', component: page('secretariaFacultad/dashboard.vue') },
      { path: 'tramite/:id', name: 'sf.tramite', component: page('secretariaFacultad/tramite.vue') },
      { path: 'tramite2/:id', name: 'sf.revisar', component: page('secretariaFacultad/tramite2.vue') }
    ]
  },

  {
    path: '/secretaria-vicerrectorado',
    component: page('secretariaVicerrectorado/index.vue'),
    children: [
      { path: '', redirect: { name: 'dashboardvice' } },
      { path: 'dashboard', name: 'dashboardvice', component: page('secretariaVicerrectorado/dashboard.vue') },
      { path: 'tramite/:id', name: 'vicerrectorado.tramite', component: page('secretariaVicerrectorado/tramite.vue') },
    ]
  },

  {
    path: '/secretaria-general-dos',
    component: page('secretariaGeneral2/index.vue'),
    children: [
      { path: '', redirect: { name: 'sg2.dashboard' } },
      { path: 'dashboard', name: 'sg2.dashboard', component: page('secretariaGeneral2/dashboard.vue') },
      { path: 'expedientes-aprobados', name: 'sg2.aprobados', component: page('secretariaGeneral2/aprobados.vue') },
      { path: 'por-imprimir', name: 'sg2.imprimir', component: page('secretariaGeneral2/imprimir.vue') },
      { path: 'programar-entrega', name: 'sg2.programar', component: page('secretariaGeneral2/programar.vue') },
      { path: 'programados', name: 'sg2.entregar', component: page('secretariaGeneral2/programados.vue') },
      
    ]
  },

  { path: '/prueva', name: 'prueva', component: page('prueva.vue') },

  { path: '*', component: page('errors/404.vue') },

]

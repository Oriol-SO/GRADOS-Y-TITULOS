import store from '~/store'

/**
 * This is middleware to check the current user role.
 *
 * middleware: 'role:admin,manager',
 */

export default (to, from, next, roles) => {
  // Grab the user
  const user = store.getters['auth/user']

  // Split roles into an array
  roles = roles.split(',')
  console.log(user.role,roles)
  // Check if the user has one of the required roles...
  if (!roles.includes('13')) {
    next('/unauthorized')
  }


  next()
}

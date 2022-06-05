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
  console.log(roles)
  const currentrol=store.getters['auth/currentRolid']
  // Check if the user has one of the required roles...
   console.log(currentrol.id)
  if (!roles.includes(currentrol.id.toString())) {
    next('/unauthorized')
  }
  next()
}

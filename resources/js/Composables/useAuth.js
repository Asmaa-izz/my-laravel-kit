import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

export default function useAuth() {
  const page = usePage()

  // جميع الصلاحيات
  const permissions = computed(() => page.props.auth?.user?.permissions || [])

  // جميع الأدوار
  const roles = computed(() => page.props.auth?.user?.roles || [])

  // دالة can لفحص صلاحية
  const can = (permissionName) => {
    return permissions.value.includes(permissionName)
  }

  // دالة hasRole لفحص دور
  const hasRole = (roleName) => {
    return roles.value.includes(roleName)
  }

  console.log(roles);
  console.log(permissions);


  return { can, hasRole, permissions, roles }
}

export const menu = [
  {
    code: 'property',
    icon: ['fas', 'file'],
    url: { name: 'property' },
    i18n: 'property',
  },
]
export const system = [
  {
    icon: ['fas', 'cogs'],
    url: { name: 'setting' },
    i18n: 'platform_administration',
    children: [
      {
        code: 'setting',
        icon: ['fas', 'user-secret'],
        url: { name: 'setting' },
        i18n: 'setting'
      },
      {
        code: 'role',
        icon: ['fas', 'user-secret'],
        url: { name: 'role' },
        i18n: 'roles_and_permissions'
      },
      {
        code: 'user',
        icon: ['fas', 'users'],
        url: { name: 'user' },
        i18n: 'user_list'
      },
      {
        code: 'province',
        icon: ['fas', 'users'],
        url: { name: 'province' },
        i18n: 'province_list'
      },
    ]
  },
]

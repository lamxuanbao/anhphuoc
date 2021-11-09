export const menu = [
  {
    code: 'contract-type',
    icon: ['fas', 'users'],
    url: { name: 'contract-type' },
    i18n: 'contract_type_list'
  },
  {
    code: 'property-type',
    icon: ['fas', 'users'],
    url: { name: 'property-type' },
    i18n: 'property_type_list',
  },
]
export const system = [
  {
    code: 'setting',
    icon: ['fas', 'cogs'],
    url: { name: 'setting' },
    i18n: 'setting',
  },
  {
    icon: ['fas', 'cogs'],
    url: { name: 'setting' },
    i18n: 'platform_administration',
    children: [
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

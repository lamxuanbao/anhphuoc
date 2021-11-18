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
        code: 'customer',
        icon: ['fas', 'users'],
        url: { name: 'customer' },
        i18n: 'customer_list'
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

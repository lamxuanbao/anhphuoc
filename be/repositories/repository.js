import AppRepository from './app_repository'
import AuthRepository from './auth_repository'
import SettingRepository from './setting_repository'
import ProvinceRepository from './province_repository'
import PropertyRepository from './property_repository'
export default ($axios) => ({
    app: AppRepository($axios),
    auth: AuthRepository($axios),
    setting: SettingRepository($axios),
    province: ProvinceRepository($axios),
    property: PropertyRepository($axios),
})
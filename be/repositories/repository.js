import AppRepository from './app_repository'
import AuthRepository from './auth_repository'
import SettingRepository from './setting_repository'
import UserRepository from './user_repository'
import RoleRepository from './role_repository'
import ProvinceRepository from './province_repository'
import DistrictRepository from './district_repository'
import WardRepository from './ward_repository'
import PropertyRepository from './property_repository'
export default ($axios) => ({
    app: AppRepository($axios),
    auth: AuthRepository($axios),
    setting: SettingRepository($axios),
    user: UserRepository($axios),
    role: RoleRepository($axios),
    province: ProvinceRepository($axios),
    district: DistrictRepository($axios),
    ward: WardRepository($axios),
    property: PropertyRepository($axios),
})
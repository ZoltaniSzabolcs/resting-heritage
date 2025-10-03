import ProfileController from './ProfileController'
import Auth from './Auth'
import CemeteryController from './CemeteryController'
import GraveController from './GraveController'
import PersonController from './PersonController'
const Controllers = {
    ProfileController: Object.assign(ProfileController, ProfileController),
Auth: Object.assign(Auth, Auth),
CemeteryController: Object.assign(CemeteryController, CemeteryController),
GraveController: Object.assign(GraveController, GraveController),
PersonController: Object.assign(PersonController, PersonController),
}

export default Controllers
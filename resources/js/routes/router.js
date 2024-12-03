import { createRouter, createWebHistory } from 'vue-router';
import { nextTick } from 'vue';

// frontend components
import HomeFront from '../components/frontend/HomeFront.vue';
import NoticeBoard from '../components/frontend/NoticeBoard.vue';
import ManagingCommunityfrontend from '../components/frontend/ManagingCommunity.vue';
import TeacherGalleryfrontend from '../components/frontend/TeacherGallery.vue';
import BoardNewsfrontend from '../components/frontend/BoardNews.vue';
import WinnergalleryAll from '../components/frontend/WinnergalleryAll.vue';
import MagazineAll from '../components/frontend/MagazineAll.vue';
import MagazinelistView from '../components/frontend/MagazinelistView.vue';
import EducatonView from '../components/frontend/EducatonView.vue';
import HealthView from '../components/frontend/HealthView.vue';
import ReligionView from '../components/frontend/ReligionView.vue';
import NewsView from '../components/frontend/NewsView.vue';
import StoryView from '../components/frontend/StoryView.vue';
import PoemView from '../components/frontend/PoemView.vue';
import JokesView from '../components/frontend/JokesView.vue';
import MagicView from '../components/frontend/MagicView.vue';

//frontend Admisson part
import AddmissionLogin from '../components/frontend/admissionform/AddmissionLogin.vue';
import AdmissionRegister from '../components/frontend/admissionform/AdmissionRegister.vue';
import AddmissionForget from '../components/frontend/admissionform/AddmissionForget.vue';
import AdmissionForm from '../components/frontend/admissionform/AdmissionForm.vue';
import AddmissionformView from '../components/frontend/admissionform/AddmissionformView.vue';

// login components
import Login from '../components/auth/Login.vue';
import Logout from '../components/auth/Logout.vue';

// backend components
import BackHome from '../components/BackHome.vue';
import UserCreate from '../components/users/UserCreate.vue';
import EditProfile from '../components/users/EditProfile.vue';
import Header from '../components/header/Header.vue';
import Heading from '../components/heading/Heading.vue';
import SlidePicturevalue from '../components/slide_picture/SlidePicturevalue.vue';
import LeftPicture from '../components/left_picture/LeftPicture.vue';
import RightPicture from '../components/right_picture/RightPicture.vue';
import TeacherStudentGellery from '../components/teacher_student_gallery/TeacherStudentGellary.vue';
import PrimemenisterPresident from '../components/primeminester_president/PrimeminesterPresident.vue';
import EducationBoard from '../components/education_board/EducationBoard.vue';
import AcademicHistory from '../components/academic_history/AcademicHistory.vue';
import Managing from '../components/managing/Managing.vue';
import TeacherGallery from '../components/teacher_gallery/TeacherGallery.vue';
import NoticeBoardBackend from '../components/notice_board/NoticeBoard.vue';
import WebsiteLink from '../components/website_link/WebsiteLink.vue';
import BoardNews from '../components/board_news/BoardNews.vue';
import WinnerGallery from '../components/winner_gallery/WinnerGallery.vue';
import Magazine from '../components/magazine/Magazine.vue';
import Campus from '../components/campus/Campus.vue';
import MediaLink from '../components/media_link/MediaLink.vue';

//backend admission setting part
import AdmissionClass from '../components/admissionsetting/addmissionclass/AdmissionClass.vue';
import AdmissionclassList from '../components/admissionsetting/addmissionclass/AdmissionclassList.vue';
import AdmissionAssign from '../components/admissionsetting/addmissionclass/AdmissionAssign.vue';


//route start
const routes = [
    //frontend part
    {
        path: '/',
        name: 'HomeFront',
        component: HomeFront,
        meta: { hideMainContent: false },
        children: [
            {
                path: 'home-noticeboard',
                components: {
                    default: HomeFront,
                    content: NoticeBoard,
                },
                meta: { hideMainContent: true },
            },
            {
                path: 'home-managingcommunity',
                components: {
                    default: HomeFront,
                    content: ManagingCommunityfrontend,
                },
                meta: { hideMainContent: true },
            },
            {
                path: 'home-teachergallery',
                components: {
                    default: HomeFront,
                    content: TeacherGalleryfrontend,
                },
                meta: { hideMainContent: true },
            },
            {
                path: 'home-winnergalleryAll',
                components: {
                    default: HomeFront,
                    content: WinnergalleryAll,
                },
                meta: { hideMainContent: true },
            },
            {
                path: 'home-magazineall',
                components: {
                    default: HomeFront,
                    content: MagazineAll,
                },
                meta: { hideMainContent: true },
            },
            {
                path: 'home-boardnews/:id',
                name: 'BoardNewsfrontend',
                components: {
                    default: HomeFront,
                    content: BoardNewsfrontend,
                },
                meta: { hideMainContent: true },
                props: { content: true },
            },
            {
                path: 'home-magazinelistview/:id',
                name: 'MagazinelistView',
                components: {
                    default: HomeFront,
                    content: MagazinelistView,
                },
                meta: { hideMainContent: true },
                props: { content: true },
            },
            {
                path: 'education_view',
                name: 'EducatonView',
                components: {
                    default: HomeFront,
                    content: EducatonView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'health_view',
                name: 'HealthView',
                components: {
                    default: HomeFront,
                    content: HealthView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'religion_view',
                name: 'ReligionView',
                components: {
                    default: HomeFront,
                    content: ReligionView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'news_view',
                name: 'NewsView',
                components: {
                    default: HomeFront,
                    content: NewsView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'story_view',
                name: 'StoryView',
                components: {
                    default: HomeFront,
                    content: StoryView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'poem_view',
                name: 'PoemView',
                components: {
                    default: HomeFront,
                    content: PoemView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'jokes_view',
                name: 'JokesView',
                components: {
                    default: HomeFront,
                    content: JokesView,
                },
                meta: { hideMainContent: true }
            },
            {
                path: 'magic_view',
                name: 'MagicView',
                components: {
                    default: HomeFront,
                    content: MagicView,
                },
                meta: { hideMainContent: true }
            },
            //HomeFront Addmission part

        ],
    },

    //login part
    { name: 'Login', component: Login, path: '/login' },
    { name: 'Logout', component: Logout, path: '/logout' },
    { name: 'AddmissionLogin', component: AddmissionLogin, path: '/admissionlogin' },
    { name: 'AdmissionRegister', component: AdmissionRegister, path: '/admissionregister' },
    { name: 'AddmissionForget', component: AddmissionForget, path: '/admissionforget' },
    { name: 'AdmissionForm', component: AdmissionForm, path: '/admissionform' },
    { name: 'AddmissionformView', component: AddmissionformView, path: '/admissionformview' },

    //backend part
    {
        path: '/admin-dashboard',
        name: 'BackHome',
        component: BackHome,
        children: [
            {
                path: '/user-create',
                name: 'UserCreate',
                components: {
                    default: BackHome,
                    content: UserCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/header',
                name: 'Header',
                components: {
                    default: BackHome,
                    content: Header,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/heading_in',
                name: 'Heading',
                components: {
                    default: BackHome,
                    content: Heading,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/slide_picture',
                name: 'SlidePicturevalue',
                components: {
                    default: BackHome,
                    content: SlidePicturevalue,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/left_picture',
                name: 'LeftPicture',
                components: {
                    default: BackHome,
                    content: LeftPicture,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/right_picture',
                name: 'RightPicture',
                components: {
                    default: BackHome,
                    content: RightPicture,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/teacher_student_gellery',
                name: 'TeacherStudentGellery',
                components: {
                    default: BackHome,
                    content: TeacherStudentGellery,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/primemenister_president',
                name: 'PrimemenisterPresident',
                components: {
                    default: BackHome,
                    content: PrimemenisterPresident,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/education_board',
                name: 'EducationBoard',
                components: {
                    default: BackHome,
                    content: EducationBoard,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/academic_history',
                name: 'AcademicHistory',
                components: {
                    default: BackHome,
                    content: AcademicHistory,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/managing',
                name: 'Managing',
                components: {
                    default: BackHome,
                    content: Managing,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/teacher_gallery',
                name: 'TeacherGallery',
                components: {
                    default: BackHome,
                    content: TeacherGallery,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/notice_board',
                name: 'NoticeBoardBackend',
                components: {
                    default: BackHome,
                    content: NoticeBoardBackend,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/website_link',
                name: 'WebsiteLink',
                components: {
                    default: BackHome,
                    content: WebsiteLink,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/board_news',
                name: 'BoardNews',
                components: {
                    default: BackHome,
                    content: BoardNews,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/winner_gallery',
                name: 'WinnerGallery',
                components: {
                    default: BackHome,
                    content: WinnerGallery,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/magazine',
                name: 'Magazine',
                components: {
                    default: BackHome,
                    content: Magazine,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/campus',
                name: 'Cumpus',
                components: {
                    default: BackHome,
                    content: Campus,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/media_link',
                name: 'MediaLink',
                components: {
                    default: BackHome,
                    content: MediaLink,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/edit_profile',
                name: 'EditProfile',
                components: {
                    default: BackHome,
                    content: EditProfile,
                },
                meta: { hideMainContent: true },
            },

            {
                path: '/admission_class',
                name: 'AdmissionClass',
                components: {
                    default: BackHome,
                    content: AdmissionClass,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/admission_classlist',
                name: 'AdmissionclassList',
                components: {
                    default: BackHome,
                    content: AdmissionclassList,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/admission_assign',
                name: 'AdmissionAssign',
                components: {
                    default: BackHome,
                    content: AdmissionAssign,
                },
                meta: { hideMainContent: true },
            },



        ]
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});



export default router;

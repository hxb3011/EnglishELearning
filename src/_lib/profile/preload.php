<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm("profile/profile.php");

function getAdminAccount()
{
    $account = new Account("0", "root99", "Hello|11", AccountStates_None);
    $key = $account->getKey();
    $key->setPermissionGranted(Permission_SystemPrivilege);
    $key->setPermissionGranted(Permission_AccountManage);
    $key->setPermissionGranted(Permission_AccountCreate);
    $key->setPermissionGranted(Permission_AccountRead);
    $key->setPermissionGranted(Permission_AccountUpdate);
    $key->setPermissionGranted(Permission_AccountDelete);
    $key->setPermissionGranted(Permission_RoleManager);
    $key->setPermissionGranted(Permission_RoleCreate);
    $key->setPermissionGranted(Permission_RoleRead);
    $key->setPermissionGranted(Permission_RoleUpdate);
    $key->setPermissionGranted(Permission_RoleDelete);
    $key->setPermissionGranted(Permission_ProfileManage);
    $key->setPermissionGranted(Permission_ProfileCreate);
    $key->setPermissionGranted(Permission_ProfileRead);
    $key->setPermissionGranted(Permission_ProfileUpdate);
    $key->setPermissionGranted(Permission_ProfileDelete);
    $key->setPermissionGranted(Permission_VerificationCreate);
    $key->setPermissionGranted(Permission_VerificationRead);
    $key->setPermissionGranted(Permission_VerificationUpdate);
    $key->setPermissionGranted(Permission_VerificationDelete);
    $key->setPermissionGranted(Permission_PaymentCreate);
    $key->setPermissionGranted(Permission_PaymentRead);
    $key->setPermissionGranted(Permission_PaymentUpdate);
    $key->setPermissionGranted(Permission_PaymentDelete);
    $key->setPermissionGranted(Permission_DictionaryManage);
    $key->setPermissionGranted(Permission_ConjugationRead);
    $key->setPermissionGranted(Permission_ConjugationWrite);
    $key->setPermissionGranted(Permission_ContributionRead);
    $key->setPermissionGranted(Permission_ContributionWrite);
    $key->setPermissionGranted(Permission_ExampleRead);
    $key->setPermissionGranted(Permission_ExampleWrite);
    $key->setPermissionGranted(Permission_LearntRecordRead);
    $key->setPermissionGranted(Permission_LearntRecordWrite);
    $key->setPermissionGranted(Permission_LemmaRead);
    $key->setPermissionGranted(Permission_LemmaWrite);
    $key->setPermissionGranted(Permission_MeaningRead);
    $key->setPermissionGranted(Permission_MeaningWrite);
    $key->setPermissionGranted(Permission_PronunciationRead);
    $key->setPermissionGranted(Permission_PronunciationWrite);
    $key->setPermissionGranted(Permission_CourseManage);
    $key->setPermissionGranted(Permission_CourseCreate);
    $key->setPermissionGranted(Permission_CourseRead);
    $key->setPermissionGranted(Permission_CourseUpdate);
    $key->setPermissionGranted(Permission_CourseDelete);
    $key->setPermissionGranted(Permission_CourseSubscribe, false);
    $key->setPermissionGranted(Permission_DocumentCreate);
    $key->setPermissionGranted(Permission_DocumentRead);
    $key->setPermissionGranted(Permission_DocumentUpdate);
    $key->setPermissionGranted(Permission_DocumentDelete);
    $key->setPermissionGranted(Permission_LessonCreate);
    $key->setPermissionGranted(Permission_LessonRead);
    $key->setPermissionGranted(Permission_LessonUpdate);
    $key->setPermissionGranted(Permission_LessonDelete);
    $key->setPermissionGranted(Permission_QuestionsCreate);
    $key->setPermissionGranted(Permission_QuestionsRead);
    $key->setPermissionGranted(Permission_QuestionsUpdate);
    $key->setPermissionGranted(Permission_QuestionsDelete);
    $key->setPermissionGranted(Permission_AnswersCreate);
    $key->setPermissionGranted(Permission_AnswersRead);
    $key->setPermissionGranted(Permission_AnswersUpdate);
    $key->setPermissionGranted(Permission_AnswersDelete);
    $key->setPermissionGranted(Permission_QAExtensionCompletion);
    $key->setPermissionGranted(Permission_QAExtensionMatching);
    $key->setPermissionGranted(Permission_QAExtensionMultipleChoices);
    $key->setPermissionGranted(Permission_BlogManage);
    $key->setPermissionGranted(Permission_PostCreate);
    $key->setPermissionGranted(Permission_PostRead);
    $key->setPermissionGranted(Permission_PostUpdate);
    $key->setPermissionGranted(Permission_PostDelete);
    $key->setPermissionGranted(Permission_CommentCreate);
    $key->setPermissionGranted(Permission_CommentRead);
    $key->setPermissionGranted(Permission_CommentUpdate);
    $key->setPermissionGranted(Permission_CommentDelete);
    return $account;
}

function getInstructorRoleFull()
{
    $role = new Role("0", "Giảng viên (Đầy đủ)");
    $key = $role->getKey();
    $key->setPermissionGranted(Permission_SystemPrivilege, true);
    $key->setPermissionGranted(Permission_AccountManage, false);
    $key->setPermissionGranted(Permission_AccountCreate, false);
    $key->setPermissionGranted(Permission_AccountRead, true);
    $key->setPermissionGranted(Permission_AccountUpdate, true);
    $key->setPermissionGranted(Permission_AccountDelete, false);
    $key->setPermissionGranted(Permission_RoleManager, false);
    $key->setPermissionGranted(Permission_RoleCreate, false);
    $key->setPermissionGranted(Permission_RoleRead, false);
    $key->setPermissionGranted(Permission_RoleUpdate, false);
    $key->setPermissionGranted(Permission_RoleDelete, false);
    $key->setPermissionGranted(Permission_ProfileManage, false);
    $key->setPermissionGranted(Permission_ProfileCreate, false);
    $key->setPermissionGranted(Permission_ProfileRead, true);
    $key->setPermissionGranted(Permission_ProfileUpdate, true);
    $key->setPermissionGranted(Permission_ProfileDelete, false);
    $key->setPermissionGranted(Permission_VerificationCreate, true);
    $key->setPermissionGranted(Permission_VerificationRead, true);
    $key->setPermissionGranted(Permission_VerificationUpdate, true);
    $key->setPermissionGranted(Permission_VerificationDelete, true);
    $key->setPermissionGranted(Permission_PaymentCreate, true);
    $key->setPermissionGranted(Permission_PaymentRead, true);
    $key->setPermissionGranted(Permission_PaymentUpdate, true);
    $key->setPermissionGranted(Permission_PaymentDelete, true);
    $key->setPermissionGranted(Permission_DictionaryManage, false);
    $key->setPermissionGranted(Permission_ConjugationRead, true);
    $key->setPermissionGranted(Permission_ConjugationWrite, true);
    $key->setPermissionGranted(Permission_ContributionRead, true);
    $key->setPermissionGranted(Permission_ContributionWrite, true);
    $key->setPermissionGranted(Permission_ExampleRead, true);
    $key->setPermissionGranted(Permission_ExampleWrite, true);
    $key->setPermissionGranted(Permission_LearntRecordRead, false);
    $key->setPermissionGranted(Permission_LearntRecordWrite, false);
    $key->setPermissionGranted(Permission_LemmaRead, true);
    $key->setPermissionGranted(Permission_LemmaWrite, true);
    $key->setPermissionGranted(Permission_MeaningRead, true);
    $key->setPermissionGranted(Permission_MeaningWrite, true);
    $key->setPermissionGranted(Permission_PronunciationRead, true);
    $key->setPermissionGranted(Permission_PronunciationWrite, true);
    $key->setPermissionGranted(Permission_CourseManage, true);
    $key->setPermissionGranted(Permission_CourseCreate, false);
    $key->setPermissionGranted(Permission_CourseRead, true);
    $key->setPermissionGranted(Permission_CourseUpdate, true);
    $key->setPermissionGranted(Permission_CourseDelete, false);
    $key->setPermissionGranted(Permission_CourseSubscribe, false);
    $key->setPermissionGranted(Permission_DocumentCreate, true);
    $key->setPermissionGranted(Permission_DocumentRead, true);
    $key->setPermissionGranted(Permission_DocumentUpdate, true);
    $key->setPermissionGranted(Permission_DocumentDelete, true);
    $key->setPermissionGranted(Permission_LessonCreate, true);
    $key->setPermissionGranted(Permission_LessonRead, true);
    $key->setPermissionGranted(Permission_LessonUpdate, true);
    $key->setPermissionGranted(Permission_LessonDelete, true);
    $key->setPermissionGranted(Permission_QuestionsCreate, true);
    $key->setPermissionGranted(Permission_QuestionsRead, true);
    $key->setPermissionGranted(Permission_QuestionsUpdate, true);
    $key->setPermissionGranted(Permission_QuestionsDelete, true);
    $key->setPermissionGranted(Permission_AnswersCreate, false);
    $key->setPermissionGranted(Permission_AnswersRead, true);
    $key->setPermissionGranted(Permission_AnswersUpdate, false);
    $key->setPermissionGranted(Permission_AnswersDelete, false);
    $key->setPermissionGranted(Permission_QAExtensionCompletion, true);
    $key->setPermissionGranted(Permission_QAExtensionMatching, true);
    $key->setPermissionGranted(Permission_QAExtensionMultipleChoices, true);
    $key->setPermissionGranted(Permission_BlogManage, false);
    $key->setPermissionGranted(Permission_PostCreate, true);
    $key->setPermissionGranted(Permission_PostRead, true);
    $key->setPermissionGranted(Permission_PostUpdate, true);
    $key->setPermissionGranted(Permission_PostDelete, true);
    $key->setPermissionGranted(Permission_CommentCreate, true);
    $key->setPermissionGranted(Permission_CommentRead, true);
    $key->setPermissionGranted(Permission_CommentUpdate, true);
    $key->setPermissionGranted(Permission_CommentDelete, true);
    return $role;
}

function getLearnerRoleFull()
{
    $role = new Role("1", "Học viên (Đầy đủ)");
    $key = $role->getKey();
    $key->setPermissionGranted(Permission_SystemPrivilege, false);
    $key->setPermissionGranted(Permission_AccountManage, false);
    $key->setPermissionGranted(Permission_AccountCreate, false);
    $key->setPermissionGranted(Permission_AccountRead, true);
    $key->setPermissionGranted(Permission_AccountUpdate, true);
    $key->setPermissionGranted(Permission_AccountDelete, false);
    $key->setPermissionGranted(Permission_RoleManager, false);
    $key->setPermissionGranted(Permission_RoleCreate, false);
    $key->setPermissionGranted(Permission_RoleRead, false);
    $key->setPermissionGranted(Permission_RoleUpdate, false);
    $key->setPermissionGranted(Permission_RoleDelete, false);
    $key->setPermissionGranted(Permission_ProfileManage, false);
    $key->setPermissionGranted(Permission_ProfileCreate, false);
    $key->setPermissionGranted(Permission_ProfileRead, true);
    $key->setPermissionGranted(Permission_ProfileUpdate, true);
    $key->setPermissionGranted(Permission_ProfileDelete, false);
    $key->setPermissionGranted(Permission_VerificationCreate, true);
    $key->setPermissionGranted(Permission_VerificationRead, true);
    $key->setPermissionGranted(Permission_VerificationUpdate, true);
    $key->setPermissionGranted(Permission_VerificationDelete, true);
    $key->setPermissionGranted(Permission_PaymentCreate, true);
    $key->setPermissionGranted(Permission_PaymentRead, true);
    $key->setPermissionGranted(Permission_PaymentUpdate, true);
    $key->setPermissionGranted(Permission_PaymentDelete, true);
    $key->setPermissionGranted(Permission_DictionaryManage, false);
    $key->setPermissionGranted(Permission_ConjugationRead, true);
    $key->setPermissionGranted(Permission_ConjugationWrite, false);
    $key->setPermissionGranted(Permission_ContributionRead, true);
    $key->setPermissionGranted(Permission_ContributionWrite, false);
    $key->setPermissionGranted(Permission_ExampleRead, true);
    $key->setPermissionGranted(Permission_ExampleWrite, false);
    $key->setPermissionGranted(Permission_LearntRecordRead, true);
    $key->setPermissionGranted(Permission_LearntRecordWrite, true);
    $key->setPermissionGranted(Permission_LemmaRead, true);
    $key->setPermissionGranted(Permission_LemmaWrite, false);
    $key->setPermissionGranted(Permission_MeaningRead, true);
    $key->setPermissionGranted(Permission_MeaningWrite, false);
    $key->setPermissionGranted(Permission_PronunciationRead, true);
    $key->setPermissionGranted(Permission_PronunciationWrite, false);
    $key->setPermissionGranted(Permission_CourseManage, false);
    $key->setPermissionGranted(Permission_CourseCreate, false);
    $key->setPermissionGranted(Permission_CourseRead, true);
    $key->setPermissionGranted(Permission_CourseUpdate, false);
    $key->setPermissionGranted(Permission_CourseDelete, false);
    $key->setPermissionGranted(Permission_CourseSubscribe, true);
    $key->setPermissionGranted(Permission_DocumentCreate, false);
    $key->setPermissionGranted(Permission_DocumentRead, true);
    $key->setPermissionGranted(Permission_DocumentUpdate, false);
    $key->setPermissionGranted(Permission_DocumentDelete, false);
    $key->setPermissionGranted(Permission_LessonCreate, false);
    $key->setPermissionGranted(Permission_LessonRead, true);
    $key->setPermissionGranted(Permission_LessonUpdate, false);
    $key->setPermissionGranted(Permission_LessonDelete, false);
    $key->setPermissionGranted(Permission_QuestionsCreate, false);
    $key->setPermissionGranted(Permission_QuestionsRead, true);
    $key->setPermissionGranted(Permission_QuestionsUpdate, false);
    $key->setPermissionGranted(Permission_QuestionsDelete, false);
    $key->setPermissionGranted(Permission_AnswersCreate, true);
    $key->setPermissionGranted(Permission_AnswersRead, true);
    $key->setPermissionGranted(Permission_AnswersUpdate, true);
    $key->setPermissionGranted(Permission_AnswersDelete, true);
    $key->setPermissionGranted(Permission_QAExtensionCompletion, false);
    $key->setPermissionGranted(Permission_QAExtensionMatching, false);
    $key->setPermissionGranted(Permission_QAExtensionMultipleChoices, false);
    $key->setPermissionGranted(Permission_BlogManage, false);
    $key->setPermissionGranted(Permission_PostCreate, true);
    $key->setPermissionGranted(Permission_PostRead, true);
    $key->setPermissionGranted(Permission_PostUpdate, true);
    $key->setPermissionGranted(Permission_PostDelete, true);
    $key->setPermissionGranted(Permission_CommentCreate, true);
    $key->setPermissionGranted(Permission_CommentRead, true);
    $key->setPermissionGranted(Permission_CommentUpdate, true);
    $key->setPermissionGranted(Permission_CommentDelete, true);
    return $role;
}

function getDemoAccount()
{
    return new Account("0", "root99", "Hello|11", AccountStates_None);
}

function getDemoInstructorProfile()
{
    $profile = new Profile("0", "Thanh Hồng", "Nguyễn", Gender_Female, "1985-03-22", ProfileType_Instructor, 0);
    $key = $profile->getKey();
    if ($key instanceof PermissionHolderKey)
        $key->set(new Account("1", "nth803", "Hello|11", AccountStates_None), getInstructorRoleFull());
    return $profile;
}

function getDemoLearnerProfile()
{
    $profile = new Profile("1", "Hiếu Thuận", "Vũ", Gender_Male, "2000-08-13", ProfileType_Learner, 0);
    $key = $profile->getKey();
    if ($key instanceof PermissionHolderKey)
        $key->set(new Account("2", "vht008", "Hello|11", AccountStates_None), getLearnerRoleFull());
    return $profile;
}

const DEBUG_ACCOUNT = 1;
const DEBUG_PROFILE = 2;
global $debug;
$debug = 0;
?>
<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm("dao/profile/profile.php");

function getPermissionHolder(): ?IPermissionHolder
{
    global $__permission_holder;
    if (isset($__permission_holder) && $__permission_holder instanceof IPermissionHolder) {
        return $__permission_holder;
    }

    if (!session_id())
        session_start();

    $authUID = &$_SESSION["AUTH_UID"];
    $holder = &$__permission_holder;
    if (isset($authUID) && is_string($authUID)) {
        $holder = ProfileDAO::getProfileByUid($authUID);
        if (isset($holder))
            return $holder;
        $holder = AccountDAO::getAccountByUid($authUID);
        if (isset($holder))
            return $holder;
    }

    return null;
}
function isSignedIn()
{
    return getPermissionHolder() !== null;
}
function isPermissionGrantedToGuest(int $permission): bool
{
    if ($permission === Permission_SystemPrivilege)
        return false;
    elseif ($permission === Permission_AccountManage)
        return false;
    elseif ($permission === Permission_AccountCreate)
        return true;
    elseif ($permission === Permission_AccountRead)
        return true;
    elseif ($permission === Permission_AccountUpdate)
        return false;
    elseif ($permission === Permission_AccountDelete)
        return false;
    elseif ($permission === Permission_RoleManager)
        return false;
    elseif ($permission === Permission_RoleCreate)
        return false;
    elseif ($permission === Permission_RoleRead)
        return true;
    elseif ($permission === Permission_RoleUpdate)
        return false;
    elseif ($permission === Permission_RoleDelete)
        return false;
    elseif ($permission === Permission_ProfileManage)
        return false;
    elseif ($permission === Permission_ProfileCreate)
        return true;
    elseif ($permission === Permission_ProfileRead)
        return true;
    elseif ($permission === Permission_ProfileUpdate)
        return false;
    elseif ($permission === Permission_ProfileDelete)
        return false;
    elseif ($permission === Permission_VerificationCreate)
        return false;
    elseif ($permission === Permission_VerificationRead)
        return false;
    elseif ($permission === Permission_VerificationUpdate)
        return false;
    elseif ($permission === Permission_VerificationDelete)
        return false;
    elseif ($permission === Permission_PaymentCreate)
        return false;
    elseif ($permission === Permission_PaymentRead)
        return true;
    elseif ($permission === Permission_PaymentUpdate)
        return false;
    elseif ($permission === Permission_PaymentDelete)
        return false;
    elseif ($permission === Permission_DictionaryManage)
        return false;
    elseif ($permission === Permission_ConjugationRead)
        return true;
    elseif ($permission === Permission_ConjugationWrite)
        return false;
    elseif ($permission === Permission_ContributionRead)
        return true;
    elseif ($permission === Permission_ContributionWrite)
        return false;
    elseif ($permission === Permission_ExampleRead)
        return true;
    elseif ($permission === Permission_ExampleWrite)
        return false;
    elseif ($permission === Permission_LearntRecordRead)
        return true;
    elseif ($permission === Permission_LearntRecordWrite)
        return false;
    elseif ($permission === Permission_LemmaRead)
        return true;
    elseif ($permission === Permission_LemmaWrite)
        return false;
    elseif ($permission === Permission_MeaningRead)
        return true;
    elseif ($permission === Permission_MeaningWrite)
        return false;
    elseif ($permission === Permission_PronunciationRead)
        return true;
    elseif ($permission === Permission_PronunciationWrite)
        return false;
    elseif ($permission === Permission_CourseManage)
        return false;
    elseif ($permission === Permission_CourseCreate)
        return false;
    elseif ($permission === Permission_CourseRead)
        return true;
    elseif ($permission === Permission_CourseUpdate)
        return false;
    elseif ($permission === Permission_CourseDelete)
        return false;
    elseif ($permission === Permission_CourseSubscribe)
        return false;
    elseif ($permission === Permission_DocumentCreate)
        return false;
    elseif ($permission === Permission_DocumentRead)
        return false;
    elseif ($permission === Permission_DocumentUpdate)
        return false;
    elseif ($permission === Permission_DocumentDelete)
        return false;
    elseif ($permission === Permission_LessonCreate)
        return false;
    elseif ($permission === Permission_LessonRead)
        return false;
    elseif ($permission === Permission_LessonUpdate)
        return false;
    elseif ($permission === Permission_LessonDelete)
        return false;
    elseif ($permission === Permission_QuestionsCreate)
        return false;
    elseif ($permission === Permission_QuestionsRead)
        return false;
    elseif ($permission === Permission_QuestionsUpdate)
        return false;
    elseif ($permission === Permission_QuestionsDelete)
        return false;
    elseif ($permission === Permission_AnswersCreate)
        return false;
    elseif ($permission === Permission_AnswersRead)
        return false;
    elseif ($permission === Permission_AnswersUpdate)
        return false;
    elseif ($permission === Permission_AnswersDelete)
        return false;
    elseif ($permission === Permission_QAExtensionCompletion)
        return false;
    elseif ($permission === Permission_QAExtensionMatching)
        return false;
    elseif ($permission === Permission_QAExtensionMultipleChoices)
        return false;
    elseif ($permission === Permission_BlogManage)
        return false;
    elseif ($permission === Permission_PostCreate)
        return false;
    elseif ($permission === Permission_PostRead)
        return true;
    elseif ($permission === Permission_PostUpdate)
        return false;
    elseif ($permission === Permission_PostDelete)
        return false;
    elseif ($permission === Permission_CommentCreate)
        return false;
    elseif ($permission === Permission_CommentRead)
        return true;
    elseif ($permission === Permission_CommentUpdate)
        return false;
    elseif ($permission === Permission_CommentDelete)
        return false;
    else
        return false;
}
function isPermissionGranted(int $permission, ?IPermissionHolder $holder = null): bool
{
    if (!isset($holder))
        $holder = getPermissionHolder();
    if (isset($holder))
        return $holder->getKey()->isPermissionGranted($permission);
    return isPermissionGrantedToGuest($permission);
}
?>
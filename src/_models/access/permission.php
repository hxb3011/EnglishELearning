<?
const Permission_SystemPrivilege = 0;
const Permission_AccountManage = 1; //*
const Permission_AccountCreate = 2;
const Permission_AccountRead = 3;
const Permission_AccountUpdate = 4;
const Permission_AccountDelete = 5;
const Permission_RoleManager = 6; //*
const Permission_RoleCreate = 7;
const Permission_RoleRead = 8;
const Permission_RoleUpdate = 9;
const Permission_RoleDelete = 10;
const Permission_ProfileManage = 11; //*
const Permission_ProfileCreate = 12;
const Permission_ProfileRead = 13;
const Permission_ProfileUpdate = 14;
const Permission_ProfileDelete = 15;
const Permission_VerificationCreate = 16;
const Permission_VerificationRead = 17;
const Permission_VerificationUpdate = 18; // ?remove
const Permission_VerificationDelete = 19;
const Permission_PaymentCreate = 20;
const Permission_PaymentRead = 21;
const Permission_PaymentUpdate = 22; // ?remove
const Permission_PaymentDelete = 23;
const Permission_DictionaryManage = 24; // *
const Permission_ConjugationRead = 25;
const Permission_ConjugationWrite = 26;
const Permission_ContributionRead = 27;
const Permission_ContributionWrite = 28;
const Permission_ExampleRead = 29;
const Permission_ExampleWrite = 30;
const Permission_LearntRecordRead = 31;
const Permission_LearntRecordWrite = 32;
const Permission_LemmaRead = 33;
const Permission_LemmaWrite = 34;
const Permission_MeaningRead = 35;
const Permission_MeaningWrite = 36;
const Permission_PronunciationRead = 37;
const Permission_PronunciationWrite = 38;
const Permission_CourseManage = 39; // *
const Permission_CourseCreate = 40;
const Permission_CourseRead = 41;
const Permission_CourseUpdate = 42;
const Permission_CourseDelete = 43;
const Permission_CourseSubscribe = 44;
const Permission_DocumentCreate = 45;
const Permission_DocumentRead = 46;
const Permission_DocumentUpdate = 47;
const Permission_DocumentDelete = 48;
const Permission_LessonCreate = 49;
const Permission_LessonRead = 50;
const Permission_LessonUpdate = 51;
const Permission_LessonDelete = 52;
const Permission_QuestionsCreate = 53;
const Permission_QuestionsRead = 54;
const Permission_QuestionsUpdate = 55;
const Permission_QuestionsDelete = 56;
const Permission_AnswersCreate = 57;
const Permission_AnswersRead = 58;
const Permission_AnswersUpdate = 59;
const Permission_AnswersDelete = 60;
const Permission_QAExtensionCompletion = 61;
const Permission_QAExtensionMatching = 62;
const Permission_QAExtensionMultipleChoices = 63;
const Permission_BlogManage = 64; // *
const Permission_PostCreate = 65;
const Permission_PostRead = 66;
const Permission_PostUpdate = 67;
const Permission_PostDelete = 68;
const Permission_CommentCreate = 69;
const Permission_CommentRead = 70;
const Permission_CommentUpdate = 71;
const Permission_CommentDelete = 72;
const PermissionMinValue = Permission_SystemPrivilege;
const PermissionMaxValue = Permission_CommentDelete;

function getPermissionKey(int $permissionValue)
{
    if ($permissionValue === Permission_SystemPrivilege)
        return "systemprivilege";
    elseif ($permissionValue === Permission_AccountManage)
        return "accountmanage";
    elseif ($permissionValue === Permission_AccountCreate)
        return "accountcreate";
    elseif ($permissionValue === Permission_AccountRead)
        return "accountread";
    elseif ($permissionValue === Permission_AccountUpdate)
        return "accountupdate";
    elseif ($permissionValue === Permission_AccountDelete)
        return "accountdelete";
    elseif ($permissionValue === Permission_RoleManager)
        return "rolemanage";
    elseif ($permissionValue === Permission_RoleCreate)
        return "rolecreate";
    elseif ($permissionValue === Permission_RoleRead)
        return "roleread";
    elseif ($permissionValue === Permission_RoleUpdate)
        return "roleupdate";
    elseif ($permissionValue === Permission_RoleDelete)
        return "roledelete";
    elseif ($permissionValue === Permission_ProfileManage)
        return "profilemanage";
    elseif ($permissionValue === Permission_ProfileCreate)
        return "profilecreate";
    elseif ($permissionValue === Permission_ProfileRead)
        return "profileread";
    elseif ($permissionValue === Permission_ProfileUpdate)
        return "profileupdate";
    elseif ($permissionValue === Permission_ProfileDelete)
        return "profiledelete";
    elseif ($permissionValue === Permission_VerificationCreate)
        return "verificationcreate";
    elseif ($permissionValue === Permission_VerificationRead)
        return "verificationread";
    elseif ($permissionValue === Permission_VerificationUpdate)
        return "verificationupdate";
    elseif ($permissionValue === Permission_VerificationDelete)
        return "verificationdelete";
    elseif ($permissionValue === Permission_PaymentCreate)
        return "paymentcreate";
    elseif ($permissionValue === Permission_PaymentRead)
        return "paymentread";
    elseif ($permissionValue === Permission_PaymentUpdate)
        return "paymentupdate";
    elseif ($permissionValue === Permission_PaymentDelete)
        return "paymentdelete";
    elseif ($permissionValue === Permission_DictionaryManage)
        return "dictionarymanage";
    elseif ($permissionValue === Permission_ConjugationRead)
        return "conjugationread";
    elseif ($permissionValue === Permission_ConjugationWrite)
        return "conjugationwrite";
    elseif ($permissionValue === Permission_ContributionRead)
        return "contributionread";
    elseif ($permissionValue === Permission_ContributionWrite)
        return "contributionwrite";
    elseif ($permissionValue === Permission_ExampleRead)
        return "exampleread";
    elseif ($permissionValue === Permission_ExampleWrite)
        return "examplewrite";
    elseif ($permissionValue === Permission_LearntRecordRead)
        return "learntrecordread";
    elseif ($permissionValue === Permission_LearntRecordWrite)
        return "learntrecordwrite";
    elseif ($permissionValue === Permission_LemmaRead)
        return "lemmaread";
    elseif ($permissionValue === Permission_LemmaWrite)
        return "lemmawrite";
    elseif ($permissionValue === Permission_MeaningRead)
        return "meaningread";
    elseif ($permissionValue === Permission_MeaningWrite)
        return "meaningwrite";
    elseif ($permissionValue === Permission_PronunciationRead)
        return "pronunciationread";
    elseif ($permissionValue === Permission_PronunciationWrite)
        return "pronunciationwrite";
    elseif ($permissionValue === Permission_CourseManage)
        return "coursemanage";
    elseif ($permissionValue === Permission_CourseCreate)
        return "coursecreate";
    elseif ($permissionValue === Permission_CourseRead)
        return "courseread";
    elseif ($permissionValue === Permission_CourseUpdate)
        return "courseupdate";
    elseif ($permissionValue === Permission_CourseDelete)
        return "coursedelete";
    elseif ($permissionValue === Permission_CourseSubscribe)
        return "coursesubscribe";
    elseif ($permissionValue === Permission_DocumentCreate)
        return "documentcreate";
    elseif ($permissionValue === Permission_DocumentRead)
        return "documentread";
    elseif ($permissionValue === Permission_DocumentUpdate)
        return "documentupdate";
    elseif ($permissionValue === Permission_DocumentDelete)
        return "documentdelete";
    elseif ($permissionValue === Permission_LessonCreate)
        return "lessoncreate";
    elseif ($permissionValue === Permission_LessonRead)
        return "lessonread";
    elseif ($permissionValue === Permission_LessonUpdate)
        return "lessonupdate";
    elseif ($permissionValue === Permission_LessonDelete)
        return "lessondelete";
    elseif ($permissionValue === Permission_QuestionsCreate)
        return "questionscreate";
    elseif ($permissionValue === Permission_QuestionsRead)
        return "questionsread";
    elseif ($permissionValue === Permission_QuestionsUpdate)
        return "questionsupdate";
    elseif ($permissionValue === Permission_QuestionsDelete)
        return "questionsdelete";
    elseif ($permissionValue === Permission_AnswersCreate)
        return "answerscreate";
    elseif ($permissionValue === Permission_AnswersRead)
        return "answersread";
    elseif ($permissionValue === Permission_AnswersUpdate)
        return "answersupdate";
    elseif ($permissionValue === Permission_AnswersDelete)
        return "answersdelete";
    elseif ($permissionValue === Permission_QAExtensionCompletion)
        return null;
    elseif ($permissionValue === Permission_QAExtensionMatching)
        return null;
    elseif ($permissionValue === Permission_QAExtensionMultipleChoices)
        return null;
    elseif ($permissionValue === Permission_BlogManage)
        return null;
    elseif ($permissionValue === Permission_PostCreate)
        return null;
    elseif ($permissionValue === Permission_PostRead)
        return null;
    elseif ($permissionValue === Permission_PostUpdate)
        return null;
    elseif ($permissionValue === Permission_PostDelete)
        return null;
    elseif ($permissionValue === Permission_CommentCreate)
        return null;
    elseif ($permissionValue === Permission_CommentRead)
        return null;
    elseif ($permissionValue === Permission_CommentUpdate)
        return null;
    elseif ($permissionValue === Permission_CommentDelete)
        return null;
    else
        return "undefined";
}

function getPermissionValueFromKey(string $permissionKey)
{
    if ($permissionKey === "systemprivilege")
        return Permission_SystemPrivilege;
    if ($permissionKey === "accountmanage")
        return Permission_AccountManage;
    if ($permissionKey === "accountcreate")
        return Permission_AccountCreate;
    if ($permissionKey === "accountread")
        return Permission_AccountRead;
    if ($permissionKey === "accountupdate")
        return Permission_AccountUpdate;
    if ($permissionKey === "accountdelete")
        return Permission_AccountDelete;
    if ($permissionKey === "rolemanage")
        return Permission_RoleManager;
    if ($permissionKey === "rolecreate")
        return Permission_RoleCreate;
    if ($permissionKey === "roleread")
        return Permission_RoleRead;
    if ($permissionKey === "roleupdate")
        return Permission_RoleUpdate;
    if ($permissionKey === "roledelete")
        return Permission_RoleDelete;
    if ($permissionKey === "profilemanage")
        return Permission_ProfileManage;
    if ($permissionKey === "profilecreate")
        return Permission_ProfileCreate;
    if ($permissionKey === "profileread")
        return Permission_ProfileRead;
    if ($permissionKey === "profileupdate")
        return Permission_ProfileUpdate;
    if ($permissionKey === "profiledelete")
        return Permission_ProfileDelete;
    if ($permissionKey === "verificationcreate")
        return Permission_VerificationCreate;
    if ($permissionKey === "verificationread")
        return Permission_VerificationRead;
    if ($permissionKey === "verificationupdate")
        return Permission_VerificationUpdate;
    if ($permissionKey === "verificationdelete")
        return Permission_VerificationDelete;
    if ($permissionKey === "paymentcreate")
        return Permission_PaymentCreate;
    if ($permissionKey === "paymentread")
        return Permission_PaymentRead;
    if ($permissionKey === "paymentupdate")
        return Permission_PaymentUpdate;
    if ($permissionKey === "paymentdelete")
        return Permission_PaymentDelete;
    if ($permissionKey === "dictionarymanage")
        return Permission_DictionaryManage;
    if ($permissionKey === "conjugationread")
        return Permission_ConjugationRead;
    if ($permissionKey === "conjugationwrite")
        return Permission_ConjugationWrite;
    if ($permissionKey === "contributionread")
        return Permission_ContributionRead;
    if ($permissionKey === "contributionwrite")
        return Permission_ContributionWrite;
    if ($permissionKey === "exampleread")
        return Permission_ExampleRead;
    if ($permissionKey === "examplewrite")
        return Permission_ExampleWrite;
    if ($permissionKey === "learntrecordread")
        return Permission_LearntRecordRead;
    if ($permissionKey === "learntrecordwrite")
        return Permission_LearntRecordWrite;
    if ($permissionKey === "lemmaread")
        return Permission_LemmaRead;
    if ($permissionKey === "lemmawrite")
        return Permission_LemmaWrite;
    if ($permissionKey === "meaningread")
        return Permission_MeaningRead;
    if ($permissionKey === "meaningwrite")
        return Permission_MeaningWrite;
    if ($permissionKey === "pronunciationread")
        return Permission_PronunciationRead;
    if ($permissionKey === "pronunciationwrite")
        return Permission_PronunciationWrite;
    if ($permissionKey === "coursemanage")
        return Permission_CourseManage;
    if ($permissionKey === "coursecreate")
        return Permission_CourseCreate;
    if ($permissionKey === "courseread")
        return Permission_CourseRead;
    if ($permissionKey === "courseupdate")
        return Permission_CourseUpdate;
    if ($permissionKey === "coursedelete")
        return Permission_CourseDelete;
    if ($permissionKey === "coursesubscribe")
        return Permission_CourseSubscribe;
    if ($permissionKey === "documentcreate")
        return Permission_DocumentCreate;
    if ($permissionKey === "documentread")
        return Permission_DocumentRead;
    if ($permissionKey === "documentupdate")
        return Permission_DocumentUpdate;
    if ($permissionKey === "documentdelete")
        return Permission_DocumentDelete;
    if ($permissionKey === "lessoncreate")
        return Permission_LessonCreate;
    if ($permissionKey === "lessonread")
        return Permission_LessonRead;
    if ($permissionKey === "lessonupdate")
        return Permission_LessonUpdate;
    if ($permissionKey === "lessondelete")
        return Permission_LessonDelete;
    if ($permissionKey === "questionscreate")
        return Permission_QuestionsCreate;
    if ($permissionKey === "questionsread")
        return Permission_QuestionsRead;
    if ($permissionKey === "questionsupdate")
        return Permission_QuestionsUpdate;
    if ($permissionKey === "questionsdelete")
        return Permission_QuestionsDelete;
    if ($permissionKey === "answerscreate")
        return Permission_AnswersCreate;
    if ($permissionKey === "answersread")
        return Permission_AnswersRead;
    if ($permissionKey === "answersupdate")
        return Permission_AnswersUpdate;
    if ($permissionKey === "answersdelete")
        return Permission_AnswersDelete;
    if ($permissionKey === "qaextensioncompletion")
        return Permission_QAExtensionCompletion;
    if ($permissionKey === "qaextensionmatching")
        return Permission_QAExtensionMatching;
    if ($permissionKey === "qaextensionmultiplechoices")
        return Permission_QAExtensionMultipleChoices;
    if ($permissionKey === "blogmanage")
        return Permission_BlogManage;
    if ($permissionKey === "postcreate")
        return Permission_PostCreate;
    if ($permissionKey === "postread")
        return Permission_PostRead;
    if ($permissionKey === "postupdate")
        return Permission_PostUpdate;
    if ($permissionKey === "postdelete")
        return Permission_PostDelete;
    if ($permissionKey === "commentcreate")
        return Permission_CommentCreate;
    if ($permissionKey === "commentread")
        return Permission_CommentRead;
    if ($permissionKey === "commentupdate")
        return Permission_CommentUpdate;
    if ($permissionKey === "commentdelete")
        return Permission_CommentDelete;
    else
        return -1;
}

function getPermissionName(int $permissionValue)
{
    if ($permissionValue === Permission_SystemPrivilege)
        return "Quản trị hệ thống";
    elseif ($permissionValue === Permission_AccountManage)
        return "Quản lý tài khoản";
    elseif ($permissionValue === Permission_AccountCreate)
        return "Thêm tài khoản";
    elseif ($permissionValue === Permission_AccountRead)
        return "Xem tài khoản";
    elseif ($permissionValue === Permission_AccountUpdate)
        return "Cập nhật tài khoản";
    elseif ($permissionValue === Permission_AccountDelete)
        return "Xoá tài khoản";
    elseif ($permissionValue === Permission_RoleManager)
        return "Quản lý vai trò";
    elseif ($permissionValue === Permission_RoleCreate)
        return "Thêm vai trò";
    elseif ($permissionValue === Permission_RoleRead)
        return "Xem vai trò";
    elseif ($permissionValue === Permission_RoleUpdate)
        return "Cập nhật vai trò";
    elseif ($permissionValue === Permission_RoleDelete)
        return "Xoá vai trò";
    elseif ($permissionValue === Permission_ProfileManage)
        return "Quản lý hồ sơ";
    elseif ($permissionValue === Permission_ProfileCreate)
        return "Thêm hồ sơ";
    elseif ($permissionValue === Permission_ProfileRead)
        return "Xem hồ sơ";
    elseif ($permissionValue === Permission_ProfileUpdate)
        return "Cập nhật hồ sơ";
    elseif ($permissionValue === Permission_ProfileDelete)
        return "Xoá hồ sơ";
    elseif ($permissionValue === Permission_VerificationCreate)
        return "Thêm xác thực";
    elseif ($permissionValue === Permission_VerificationRead)
        return "Xem xác thực";
    elseif ($permissionValue === Permission_VerificationUpdate)
        return "Cập nhật xác thực";
    elseif ($permissionValue === Permission_VerificationDelete)
        return "Xoá xác thực";
    elseif ($permissionValue === Permission_PaymentCreate)
        return "Thêm thanh toán";
    elseif ($permissionValue === Permission_PaymentRead)
        return "Xem thanh toán";
    elseif ($permissionValue === Permission_PaymentUpdate)
        return "Cập nhật thanh toán";
    elseif ($permissionValue === Permission_PaymentDelete)
        return "Xoá thanh toán";
    elseif ($permissionValue === Permission_DictionaryManage)
        return "Quản lý từ điển";
    elseif ($permissionValue === Permission_ConjugationRead)
        return "Xem chia động từ";
    elseif ($permissionValue === Permission_ConjugationWrite)
        return "Ghi chia động từ";
    elseif ($permissionValue === Permission_ContributionRead)
        return "Xem đóng góp";
    elseif ($permissionValue === Permission_ContributionWrite)
        return "Ghi đóng góp";
    elseif ($permissionValue === Permission_ExampleRead)
        return "Xem ví dụ";
    elseif ($permissionValue === Permission_ExampleWrite)
        return "Ghi ví dụ";
    elseif ($permissionValue === Permission_LearntRecordRead)
        return "Xem bản ghi học tập";
    elseif ($permissionValue === Permission_LearntRecordWrite)
        return "Ghi bản ghi học tập";
    elseif ($permissionValue === Permission_LemmaRead)
        return "Xem từ vị";
    elseif ($permissionValue === Permission_LemmaWrite)
        return "Ghi từ vị";
    elseif ($permissionValue === Permission_MeaningRead)
        return "Xem nghĩa";
    elseif ($permissionValue === Permission_MeaningWrite)
        return "Ghi nghĩa";
    elseif ($permissionValue === Permission_PronunciationRead)
        return "Xem phát âm";
    elseif ($permissionValue === Permission_PronunciationWrite)
        return "Ghi phát âm";
    elseif ($permissionValue === Permission_CourseManage)
        return "Quản lý khoá học";
    elseif ($permissionValue === Permission_CourseCreate)
        return "Thêm khoá học";
    elseif ($permissionValue === Permission_CourseRead)
        return "Xem khoá học";
    elseif ($permissionValue === Permission_CourseUpdate)
        return "Cập nhật khoá học";
    elseif ($permissionValue === Permission_CourseDelete)
        return "Xoá khoá học";
    elseif ($permissionValue === Permission_CourseSubscribe)
        return "Đăng ký khoá học";
    elseif ($permissionValue === Permission_DocumentCreate)
        return "Thêm tài liệu";
    elseif ($permissionValue === Permission_DocumentRead)
        return "Xem tài liệu";
    elseif ($permissionValue === Permission_DocumentUpdate)
        return "Cập nhật tài liệu";
    elseif ($permissionValue === Permission_DocumentDelete)
        return "Xoá tài liệu";
    elseif ($permissionValue === Permission_LessonCreate)
        return "Thêm bài học";
    elseif ($permissionValue === Permission_LessonRead)
        return "Xem bài học";
    elseif ($permissionValue === Permission_LessonUpdate)
        return "Cập nhật bài học";
    elseif ($permissionValue === Permission_LessonDelete)
        return "Xoá bài học";
    elseif ($permissionValue === Permission_QuestionsCreate)
        return "Thêm câu hỏi";
    elseif ($permissionValue === Permission_QuestionsRead)
        return "Xem câu hỏi";
    elseif ($permissionValue === Permission_QuestionsUpdate)
        return "Cập nhật câu hỏi";
    elseif ($permissionValue === Permission_QuestionsDelete)
        return "Xoá câu hỏi";
    elseif ($permissionValue === Permission_AnswersCreate)
        return "Thêm câu trả lời";
    elseif ($permissionValue === Permission_AnswersRead)
        return "Xem câu trả lời";
    elseif ($permissionValue === Permission_AnswersUpdate)
        return "Cập nhật câu trả lời";
    elseif ($permissionValue === Permission_AnswersDelete)
        return "Xoá câu trả lời";
    elseif ($permissionValue === Permission_QAExtensionCompletion)
        return "Câu hỏi điền khuyết (mở rộng)";
    elseif ($permissionValue === Permission_QAExtensionMatching)
        return "Câu hỏi ghép cột (mở rộng)";
    elseif ($permissionValue === Permission_QAExtensionMultipleChoices)
        return "Câu hỏi lựa chọn (mở rộng)";
    elseif ($permissionValue === Permission_BlogManage)
        return "Quản lý blog";
    elseif ($permissionValue === Permission_PostCreate)
        return "Thêm bài viết";
    elseif ($permissionValue === Permission_PostRead)
        return "Xem bài viết";
    elseif ($permissionValue === Permission_PostUpdate)
        return "Cập nhật bài viết";
    elseif ($permissionValue === Permission_PostDelete)
        return "Xoá bài viết";
    elseif ($permissionValue === Permission_CommentCreate)
        return "Thêm bình luận";
    elseif ($permissionValue === Permission_CommentRead)
        return "Xem bình luận";
    elseif ($permissionValue === Permission_CommentUpdate)
        return "Cập nhật bình luận";
    elseif ($permissionValue === Permission_CommentDelete)
        return "Xoá bình luận";
    else
        return "(Chưa định nghĩa)";
}

const AccountStates_None = 0;
const AccountStates_Linked = 1;
const AccountStates_Disabled = 2;
const AccountStates_Deleted = 4;

interface IPermissionHolderKey
{
    function getAccount(): Account|null;
    function getRole(): Role|null;
    function isPermissionGranted(int $permission): bool;
    function setPermissionGranted(int $permission, bool $value = true): void;
}

interface IPermissionHolder
{
    function getKey(): IPermissionHolderKey;
}

final class _PermissionHolderKey implements IPermissionHolderKey
{
    private IPermissionHolder $_holder;
    private array|null $_binaryPermissions;

    function __construct(IPermissionHolder $holder)
    {
        $this->_holder = $holder;
        $this->_binaryPermissions = null;
    }

    function getAccount(): Account|null
    {
        $holder = $this->_holder;
        if (!($holder instanceof Account))
            $holder = null;
        return $holder;
    }

    function getRole(): Role|null
    {
        $holder = $this->_holder;
        if (!($holder instanceof Role))
            $holder = null;
        return $holder;
    }

    function isPermissionGranted(int $permission): bool
    {
        $bs = &$this->_binaryPermissions;
        if (!isset($bs))
            $bs = array_fill(0, 60, 0);
        $x = $permission >> 3;
        $y = ~$permission & 0x7;
        return (($bs[$x] >> $y) & 1) === 1;
    }

    function setPermissionGranted(int $permission, bool $granted = true): void
    {
        $bs = &$this->_binaryPermissions;
        if (!isset($bs))
            $bs = array_fill(0, 60, 0);
        $x = $permission >> 3;
        $y = 1 << (~$permission & 0x7);
        if ($granted)
            $bs[$x] |= $y;
        else
            $bs[$x] &= ~$y;
    }

    function loadPermissions(string $permissions)
    {
        if (!$permissions)
            return false;
        $permissions = base64_decode($permissions);
        if ($permissions === false)
            return false;
        $permissions = unpack("C*", $permissions);
        if ($permissions === false)
            return false;
        $bs = &$this->_binaryPermissions;
        if (!isset($bs))
            $bs = array_fill(0, 60, 0);
        for ($i = 0, $j = 1, $m = count($bs), $n = count($permissions); $i < $m; )
            $bs[$i++] = $j <= $n ? $permissions[$j++] : 0;
        return true;
    }

    function savePermissions()
    {
        $binaryPermissions = $this->_binaryPermissions;
        if (!isset($binaryPermissions))
            return "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA";
        return base64_encode(call_user_func_array("pack", array_merge(array("C*"), $binaryPermissions)));
    }
}

final class PermissionHolderKey implements IPermissionHolderKey
{
    private Account|null $_account;
    private Role|null $_role;
    public function __construct()
    {
        $this->_account = null;
        $this->_role = null;
    }

    function getAccount(): Account|null
    {
        return $this->_account;
    }

    function getRole(): Role|null
    {
        return $this->_role;
    }

    function isPermissionGranted(int $permission): bool
    {
        $k = $this->getRole();
        $result = isset($k) && $k->getKey()->isPermissionGranted($permission);
        $k = $this->getAccount();
        return $result || (isset($k) && $k->getKey()->isPermissionGranted($permission));
    }

    function setPermissionGranted(int $permission, bool $granted = true): void
    {
        $h = $this->getRole();
        if (isset($h) && $h->getKey()->isPermissionGranted($permission) && $granted)
            return;
        $h = $this->getAccount();
        if (!isset($h))
            return;
        $h = $h->getKey();
        if ($h->isPermissionGranted($permission) && $granted)
            return;
        $h->setPermissionGranted($permission, $granted);
    }

    function set(Account|null $account = null, Role|null $role = null)
    {
        $a = $this->getAccount();
        if (isset($a))
            $a->setLinked(false);
        $this->_account = $account;
        if (isset($account))
            $account->setLinked(true);
        $this->_role = $role;
    }

    static function loadPermissions(IPermissionHolder $i, string $permissions)
    {
        if (!isset($i))
            return false;
        $i = $i->getKey();
        if (!($i instanceof _PermissionHolderKey))
            return false;
        return $i->loadPermissions($permissions);
    }

    static function savePermissions(IPermissionHolder $i)
    {
        if (!isset($i))
            return false;
        $i = $i->getKey();
        if (!($i instanceof _PermissionHolderKey))
            return false;
        return $i->savePermissions();
    }
}

final class Account implements IPermissionHolder
{
    private string $_uid;
    public string $userName;
    public string $password;
    private int $_state;
    private ?_PermissionHolderKey $_key;
    function __construct(string $uid, string $userName = "", string $password = "", int $state = AccountStates_None)
    {
        $this->_uid = $uid;
        $this->userName = $userName;
        $this->password = $password;
        $this->_state = $state;
    }
    private function hasAccountStateFlags(int $flag)
    {
        return ($this->_state & $flag) === $flag;
    }
    private function setAccountStateFlags(int $flag, bool $value)
    {
        if (!$this->hasAccountStateFlags($flag) === $value) {
            if ($value)
                $this->_state |= $flag;
            else
                $this->_state &= ~$flag;
        }
    }
    function isDisabled()
    {
        return $this->hasAccountStateFlags(AccountStates_Disabled);
    }
    function setDisabled(bool $value)
    {
        $this->setAccountStateFlags(AccountStates_Disabled, $value);
    }
    function isLinked()
    {
        return $this->hasAccountStateFlags(AccountStates_Linked);
    }
    function setLinked(bool $value)
    {
        $this->setAccountStateFlags(AccountStates_Linked, $value);
    }
    function isDeleted()
    {
        return $this->hasAccountStateFlags(AccountStates_Deleted);
    }
    function setDeleted(bool $value)
    {
        $this->setAccountStateFlags(AccountStates_Deleted, $value);
    }
    function getUid()
    {
        return $this->_uid;
    }
    function getState()
    {
        return $this->_state;
    }
    function getKey(): IPermissionHolderKey
    {
        $key = &$this->_key;
        if (!isset($key))
            $key = new _PermissionHolderKey($this);
        return $key;
    }
}

final class Role implements IPermissionHolder
{
    private string $_id;
    public string $name;
    private ?_PermissionHolderKey $_key;
    function __construct(string $id, string $name = "")
    {
        $this->_id = $id;
        $this->name = $name;
    }
    function getId()
    {
        return $this->_id;
    }
    function getKey(): IPermissionHolderKey
    {
        $key = &$this->_key;
        if (!isset($key))
            $key = new _PermissionHolderKey($this);
        return $key;
    }
}
?>
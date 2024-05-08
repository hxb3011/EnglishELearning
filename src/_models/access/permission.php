<?
const Permission_SystemPrivilege = 1;
const Permission_AccountManage = 2; //*
const Permission_AccountCreate = 3;
const Permission_AccountRead = 4;
const Permission_AccountUpdate = 5;
const Permission_AccountDelete = 6;
const Permission_RoleManager = 7; //*
const Permission_RoleCreate = 8;
const Permission_RoleRead = 9;
const Permission_RoleUpdate = 10;
const Permission_RoleDelete = 11;
const Permission_ProfileManage = 12; //*
const Permission_ProfileCreate = 13;
const Permission_ProfileRead = 14;
const Permission_ProfileUpdate = 15;
const Permission_ProfileDelete = 16;
const Permission_VerificationCreate = 17;
const Permission_VerificationRead = 18;
const Permission_VerificationUpdate = 19;
const Permission_VerificationDelete = 20;
const Permission_PaymentCreate = 21;
const Permission_PaymentRead = 22;
const Permission_PaymentUpdate = 23;
const Permission_PaymentDelete = 24;
const Permission_DictionaryManage = 25; // *
const Permission_ConjugationRead = 26;
const Permission_ConjugationWrite = 27;
const Permission_ContributionRead = 28;
const Permission_ContributionWrite = 29;
const Permission_ExampleRead = 30;
const Permission_ExampleWrite = 31;
const Permission_LearntRecordRead = 32;
const Permission_LearntRecordWrite = 33;
const Permission_LemmaRead = 34;
const Permission_LemmaWrite = 35;
const Permission_MeaningRead = 36;
const Permission_MeaningWrite = 37;
const Permission_PronunciationRead = 38;
const Permission_PronunciationWrite = 39;
const Permission_CourseManage = 40; // *
const Permission_CourseCreate = 41;
const Permission_CourseRead = 42;
const Permission_CourseUpdate = 43;
const Permission_CourseDelete = 44;
const Permission_CourseSubscribe = 45;
const Permission_DocumentCreate = 46;
const Permission_DocumentRead = 47;
const Permission_DocumentUpdate = 48;
const Permission_DocumentDelete = 49;
const Permission_LessonCreate = 50;
const Permission_LessonRead = 51;
const Permission_LessonUpdate = 52;
const Permission_LessonDelete = 53;
const Permission_QuestionsCreate = 54;
const Permission_QuestionsRead = 55;
const Permission_QuestionsUpdate = 56;
const Permission_QuestionsDelete = 57;
const Permission_AnswersCreate = 58;
const Permission_AnswersRead = 59;
const Permission_AnswersUpdate = 60;
const Permission_AnswersDelete = 61;
const Permission_QAExtensionCompletion = 62;
const Permission_QAExtensionMatching = 63;
const Permission_QAExtensionMultipleChoices = 64;
const Permission_BlogManage = 65; // *
const Permission_PostCreate = 66;
const Permission_PostRead = 67;
const Permission_PostUpdate = 68;
const Permission_PostDelete = 69;
const Permission_CommentCreate = 70;
const Permission_CommentRead = 71;
const Permission_CommentUpdate = 72;
const Permission_CommentDelete = 73;

const AccountStates_None = 0;
const AccountStates_Linked = 1;
const AccountStates_Disabled = 2;

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

    function isPermissionGranted($permission): bool
    {
        $bs = $this->_binaryPermissions;
        if (!isset($bs))
            $this->_binaryPermissions = $bs = array_fill(0, 60, 0);
        $x = $permission >> 3;
        $y = ~$permission & 0x7;
        return (($bs[$x] >> $y) & 1) === 1;
    }

    function setPermissionGranted($permission, bool $granted = true): void
    {
        $bs = $this->_binaryPermissions;
        if (!isset($bs))
            $this->_binaryPermissions = $bs = array_fill(0, 60, 0);
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
        $permissions = unpack("C*", base64_decode($permissions));
        if ($permissions === false)
            return false;
        $bs = $this->_binaryPermissions;
        if (!isset($bs))
            $this->_binaryPermissions = $bs = array_fill(0, 60, 0);
        for ($i = 0, $j = 0, $m = count($bs), $n = count($permissions); $i < $m; )
            $bs[$i++] = $j < $n ? $permissions[$j++] : 0;
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

    function isPermissionGranted($permission): bool
    {
        $k = $this->getRole();
        $result = isset($k) && $k->getKey()->isPermissionGranted($permission);
        $k = $this->getAccount();
        return $result || (isset($k) && $k->getKey()->isPermissionGranted($permission));
    }

    function setPermissionGranted($permission, bool $granted = true): void
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
    private _PermissionHolderKey $_key;
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
        $key = $this->_key;
        if (!isset($key))
            $this->_key = $key = new _PermissionHolderKey($this);
        return $key;
    }
}

final class Role implements IPermissionHolder
{
    private string $_id;
    public string $_name;
    private _PermissionHolderKey $_key;
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
        $key = $this->_key;
        if (!isset($key))
            $this->_key = $key = new _PermissionHolderKey($this);
        return $key;
    }
}
?>
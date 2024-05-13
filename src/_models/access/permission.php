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
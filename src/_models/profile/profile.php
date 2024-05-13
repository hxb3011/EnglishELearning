<?
require_once "/var/www/html/_lib/utils/requir.php";
requirm('/access/permission.php');

const Gender_Male = 0;
const Gender_Female = 1;
const ProfileType_Instructor = 0;
const ProfileType_Learner = 1;

final class Profile implements IPermissionHolder
{
    private string $id;
    public string $firstName;
    public string $lastName;
    public int $gender;
    public string $birthday;
    public int $type;
    public int $status;
    private ?PermissionHolderKey $_key;
    public function __construct(string $id, string $firstName = "", string $lastName = "", int $gender = Gender_Male, string $birthday = "2000-01-01", int $type = ProfileType_Learner, int $status = 0)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->type = $type;
        $this->status = $status;
    }
    function getId()
    {
        return $this->id;
    }
    function getAccount()
    {
        return $this->getKey()->getAccount();
    }
    function getKey(): IPermissionHolderKey
    {
        $key = &$this->_key;
        if (!isset($key))
            $key = new PermissionHolderKey();
        return $key;
    }
    function getRole()
    {
        return $this->getKey()->getRole();
    }
}

?>
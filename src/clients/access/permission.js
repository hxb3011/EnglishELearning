// @ts-check
// require: /clients/utils.js
/** @enum {number} */
const EPermissions = {
    perm1: 1,
    perm2: 2,
    perm3: 3,
    perm4: 4
};
/** @enum {number} */
const EAccountStates = {
    none: 0x0,
    linked: 0x1,
    disabled: 0x2
};
/**
    @typedef {{
        readonly account: IAccount?;
        readonly role: IRole?;
        isPermissionGranted(permission: EPermissions): boolean;
        setPermissionGranted(permission: EPermissions, value?: boolean): void;
    }} IPermissionHolderKey

    @typedef {{
        readonly key: IPermissionHolderKey;
    }} IPermissionHolder

    @typedef {IPermissionHolder & {
        readonly uid: bigint;
        userName: string;
        password: string;
        disabled: boolean;
        linked: boolean;
        readonly state: EAccountStates;
    }} IAccount

    @typedef {IPermissionHolder & {
        readonly id: bigint;
        name: string;
    }} IRole

    @type {{
        new(uid: bigint, userName?: string, password?: string, state?: EAccountStates): IAccount;
        prototype: IAccount;
    }}

    @param uid
    @param userName
    @param password
    @param state
 */
// @ts-expect-error
const Account = function (uid, userName, password, state) {
    /** @type {bigint} */
    this._uid = uid;
    /** @type {string} */
    this.userName = udef("", userName);
    /** @type {string} */
    this.password = udef("", password);
    /** @type {EAccountStates} */
    this._state = udef(EAccountStates.none, state);
};

/**
    @type {{
        new(id: bigint, name?: string): IRole;
        prototype: IRole;
    }}

    @param id
    @param name
*/
// @ts-expect-error
const Role = function (id, name) {
    /** @type {bigint} */
    this._id = id;
    /** @type {string} */
    this.name = udef("", name);
};

/**
    @type {{
        new(): IPermissionHolderKey & { set(account?: Account, role?: Role): void; };
        prototype: IPermissionHolderKey & { set(account?: Account, role?: Role): void; };
    }}
*/
// @ts-expect-error
const PermissionHolderKey = function () {
};

(() => {
    /**
        @type {{
            new(holder: IPermissionHolder): IPermissionHolderKey & {
                _binaryPermissions: Uint8Array;
                _holder: IPermissionHolder;
                loadPermissions(permissions?: Uint8Array?): void;
            };
            prototype: IPermissionHolderKey & {
                _binaryPermissions: Uint8Array;
                _holder: IPermissionHolder;
                loadPermissions(permissions?: Uint8Array?): void;
            };
        }}

        @param holder 
     */
    // @ts-expect-error
    const PermissionHolderIKey = function (holder) {
        this._holder = holder;
    }

    const PermissionHolderIKey_prototype = /**
        @type {IPermissionHolderKey & {
            _binaryPermissions: Uint8Array;
            _holder: IPermissionHolder;
            loadPermissions(permissions?: Uint8Array?): void;
        }}
    */ (PermissionHolderIKey.prototype);
    const PermissionHolderEKey_prototype = /**
        @type {IPermissionHolderKey & {
            _account?: IAccount;
            _role?: IRole;
            set(account?: IAccount, role?: IRole): void;
        }}
    */ (PermissionHolderKey.prototype);
    const Account_prototype = /** @type {IAccount} */ (Account.prototype);
    const Role_prototype = /** @type {IRole} */ (Role.prototype);

    Object.defineProperties(PermissionHolderIKey_prototype, {
        account: {
            /** @this {typeof PermissionHolderIKey_prototype} */
            get() {
                const account = this._holder;
                return Object.getPrototypeOf(account) === Account.prototype
                    ? account : null;
            }
        },
        role: {
            /** @this {typeof PermissionHolderIKey_prototype} */
            get() {
                const role = this._holder;
                return Object.getPrototypeOf(role) === Role.prototype
                    ? role : null
            }
        }
    });
    /** @this {typeof PermissionHolderIKey_prototype} */
    // @ts-expect-error
    PermissionHolderIKey_prototype.isPermissionGranted = function (permission) {
        let bs = this._binaryPermissions;
        if (!bs) this._binaryPermissions =
            bs = new Uint8Array(64);
        let x = permission >>> 3, y = ~permission & 0x7;
        return ((bs[x] >>> y) & 1) === 1;
    };
    /** @this {typeof PermissionHolderIKey_prototype} */
    PermissionHolderIKey_prototype.setPermissionGranted = function (permission, granted) {
        let bs = this._binaryPermissions;
        if (!bs) this._binaryPermissions =
            bs = new Uint8Array(64);
        let x = permission >>> 3, y = 1 << (~permission & 0x7);
        if (granted !== false) bs[x] |= y;
        else bs[x] &= ~y;
    };
    /** @this {typeof PermissionHolderIKey_prototype} */
    PermissionHolderIKey_prototype.loadPermissions = function (permissions) {
        if (!permissions) return;
        let bs = this._binaryPermissions;
        if (bs == null) this._binaryPermissions =
            bs = new Uint8Array(64);
        for (let i = 0, j = 0, m = bs.length,
            n = permissions.length; i < m;)
            bs[i++] = j < n ? permissions[j++] : 0;
    };

    Object.defineProperties(PermissionHolderEKey_prototype, {
        account: {
            /** @this {typeof PermissionHolderEKey_prototype} */
            get() { return this._account || null; }
        },
        role: {
            /** @this {typeof PermissionHolderEKey_prototype} */
            get() { return this._role || null; }
        }
    });
    /** @this {typeof PermissionHolderEKey_prototype} */
    PermissionHolderEKey_prototype.isPermissionGranted = function (permission) {
        let k;
        return ((k = this.role) && k.key.isPermissionGranted(permission))
            || ((k = this.account) && k.key.isPermissionGranted(permission))
            ? true : false;
    };
    /** @this {typeof PermissionHolderEKey_prototype} */
    PermissionHolderEKey_prototype.setPermissionGranted = function (permission, granted) {
        granted = granted !== false;
        let h, k;
        if ((h = this.role) && h.key.isPermissionGranted(permission) && granted) return;
        if ((h = this.account) && (!(k = h.key).isPermissionGranted(permission) || !granted))
            k.setPermissionGranted(permission, granted);
    };
    /** @this {typeof PermissionHolderEKey_prototype} */
    PermissionHolderEKey_prototype.set = function (account, role) {
        let a = this.account;
        if (a) a.linked = false;
        this._account = account;
        if (account) account.linked = true;
        this._role = role;
    };

    function hasAccountStateFlags(/** @type {EAccountStates} */ flag) { return (this._state & flag) === flag; }
    function setAccountStateFlags(/** @type {EAccountStates} */ flag, /** @type {boolean} */ value) {
        if (!hasAccountStateFlags(flag) === value) {
            if (value) this._state |= flag;
            else this._state &= ~flag;
        }
    }
    const getKey = {
        /** @this {IPermissionHolder & { _key: IPermissionHolderKey; }} */
        get() {
            let key = this._key;
            if (key) this._key =
                key = new PermissionHolderIKey(this);
            return key;
        }
    }
    Object.defineProperties(Account_prototype, {
        disabled: { get() { return hasAccountStateFlags(EAccountStates.disabled); }, set(value) { setAccountStateFlags(EAccountStates.disabled, value); } },
        linked: { get() { return hasAccountStateFlags(EAccountStates.linked); }, set(value) { setAccountStateFlags(EAccountStates.linked, value); } },
        state: { get() { return this._state; } },
        uid: { get() { return this._uid; } },
        key: getKey
    });
    Object.defineProperties(Role_prototype, {
        id: { get() { return this._id; } },
        key: getKey
    });
})();
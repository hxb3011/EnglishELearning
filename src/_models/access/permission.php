<?
// interface IPermissionHolder {
//     readonly account: IAccount;
//     readonly role: IRole;
//     isPermissionGranted(permission: EPermissions): boolean;
//     setPermissionGranted(permission: EPermissions, value: boolean = true): void;
// }

// interface IPermissionHolderKey extends IPermissionHolder {
//     binaryPermissions: Uint8Array;
// }

// interface IPermissionHandler extends IPermissionHolder {
//     set(account?: Account, role?: Role): void;
// }

// interface IAccount extends IPermissionHolderKey {
//     readonly uid: bigint;
//     userName: string;
//     password: string;
//     disabled: boolean;
//     linked: boolean;
//     readonly state: EAccountStates;
// }

// interface IRole extends IPermissionHolderKey {
//     readonly id: bigint;
//     name: string;
// }

// declare var PermissionHandler: {
//     prototype: IPermissionHandler
// }

// declare var Account: {
//     prototype: IAccount
//     new(uid: bigint, userName: string = "", password: string = "", state: EAccountStates = EAccountStates.none): IAccount
// }

// declare var Role: {
//     prototype: IRole
//     new(id: bigint, name: string = ""): IRole
// }
?>
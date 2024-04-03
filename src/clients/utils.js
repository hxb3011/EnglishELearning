//@ts-check

/**
 * @template T
 * @param {T} def 
 * @param {T} [val] 
 */
function udef(def, val) { return val !== undefined ? val : def; }

/** @typedef {`v`|`d`|`i`|`w`|`e`} LogPriorities */
const log = (() => {
    /** @type {{ [priority in LogPriorities]: (...data: string[]) => void; }} */
    const lgf = {
        v: console.log, d: console.debug,
        i: console.info, w: console.warn, e: console.error
    };

    /** @this {{ f(...data: any[]): void; t: string }} */
    function lgb() {
        const logFunc = this.f;
        logFunc(`[${this.t}]#${arguments
            .callee.caller.caller.name}`);
        logFunc(...arguments);
    }

    /**
     * @param {LogPriorities} priority
     * @param {string} tag
     */
    function log(priority, tag) {
        lgb.call({ f: lgf[priority], t: tag },
            ...Array.prototype.slice.call(arguments, 2));
    }

    /** @param {string} tag */
    log.bindTag = function (tag) {
        /**
         * @param {LogPriorities} priority
         */
        function func(priority) {
            lgb.call({ f: lgf[priority], t: tag },
                ...Array.prototype.slice.call(arguments, 1));
        };
        /**
         * @param {LogPriorities} priority
         * @returns {(...args: any[]) => void}
         */
        func.bindPriority = function (priority) {
            return func.bind(this, priority);
        }
        return func;
    };

    /** @param {LogPriorities} priority */
    log.bindPriority = function (priority) {
        /**
         * @param {string} tag
         */
        function func(tag) {
            lgb.call({ f: lgf[priority], t: tag },
                ...Array.prototype.slice.call(arguments, 1));
        }
        /**
         * @param {string} tag
         * @returns {(...args: any[]) => void}
         */
        func.bindTag = function (tag) {
            return func.bind(this, tag);
        }
        return func;
    };

    log.VERBOSE = `v`;
    log.DEBUG = `d`;
    log.INFO = `i`;
    log.WARN = `w`;
    log.ERROR = `e`;
    return log;
})();
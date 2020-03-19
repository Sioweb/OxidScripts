[{$smarty.block.parent}]
<script>
(function (window) {

    var oxCallbacks = new (function () {

        /** selfObj or that ... */
        var selfObj = this;

        this.events = {
            'oxOnload': {},
            'oxArticleVariantReload': {}
        };

        /**
         * @param string eventName
         * @param function callback: Anonymous function with event paramaters
         * @param number priority: (optional) Number with priority. All events will be registrated in 100 steps (0, 100, 200) per default
         */
        this.registrate = function (eventName, callback) {
            var priority = arguments[2] || null;

            if (selfObj.events[eventName] === undefined) {
                selfObj.events[eventName] = {};
                if (priority === null) {
                    priority = 0;
                }
            } else if (priority === null) {
                priority = selfObj.latestPriority(eventName);
            }

            if (selfObj.events[eventName][priority] === undefined) {
                selfObj.events[eventName][priority] = [];
            }

            if (typeof callback !== 'object') {
                callback = [callback, []];
            }
            selfObj.events[eventName][priority].push(callback);

            selfObj.sortEvent(eventName);
        };

        /**
         * @param string eventName 
         * @param Array params: (optional) Parameters which will be passed to all callbacks
         */
        this.fire = function (eventName) {
            var arrParams = arguments[1] || [];

            if (selfObj.events[eventName] !== undefined && Object.keys(selfObj.events[eventName]).length) {

                if (typeof arrParams !== 'object') {
                    arrParams = [arrParams];
                }

                for (var priority in selfObj.events[eventName]) {
                    for(var i in selfObj.events[eventName][priority]) {
                        if (typeof selfObj.events[eventName][priority][i][0] === 'function') {
                            try {
                                selfObj.events[eventName][priority][i][0].apply(null, arrParams.concat(selfObj.events[eventName][priority][i][1]));
                            } catch (e) { }
                        }
                    }
                }
                selfObj.events[eventName] = [];
            }
        };

        this.latestPriority = function (eventName) {
            var Priorities = Object.keys(selfObj.events[eventName]);

            if (!Priorities.length) {
                return 0;
            }

            return (parseInt(Priorities[Priorities.length - 1], 10) + 100);
        };

        this.sortEvent = function (eventName) {
            var Priorities = Object.keys(selfObj.events[eventName]),
                _sortedPriorities = {};

            Priorities = Priorities.sort();
            for (var priority in Priorities) {
                _sortedPriorities[priority] = selfObj.events[eventName][Priorities[priority]];
            }

            return _sortedPriorities;
        };

        return this;
    })();

    window['oxCallbacks'] = oxCallbacks;
})(window);
</script>
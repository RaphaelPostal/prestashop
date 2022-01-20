(function (window) {
    'use strict';

    function $http(url) {
        var core = {
            // La méthode qui effectue la requête AJAX
            ajax: function (method, url, args, isFormData) {

                // On établit une promesse en retour
                var promise = new Promise(function (resolve, reject) {
                    // On instancie un XMLHttpRequest
                    var client = new XMLHttpRequest();
                    var uri = url;

                    isFormData = typeof isFormData !== "undefined" ? isFormData : false;
                    var data = null;

                    if (args && (method === 'POST' || method === 'PUT') && !isFormData) {
                        data = JSON.stringify(args);
                    }

                    if (args && (method === 'POST' || method === 'PUT') && isFormData) {
                        data = args;
                    }



                    client.open(method, uri, true);
                    if (method === 'POST' && !isFormData) {
                        //Send the proper header information along with the request
                        client.setRequestHeader('Content-type', "application/json;");

                    }
                    client.send(data);

                    client.onload = function () {
                        if (this.status >= 200 && this.status < 300) {
                            // On utilise la fonction "resolve" lorsque this.status vaut 2xx
                            resolve(this.response);
                        } else {
                            // On utilise la fonction "reject" lorsque this.status est différent de 2xx
                            reject(this.statusText);
                        }
                    };

                    client.onerror = function () {
                        reject(this.statusText);
                    };

                });

                // Return the promise
                return promise;
            }
        };

        // Pattern adaptateur
        return {
            'get': function (args) {
                return core.ajax('GET', url, args);
            },
            'post': function (args, isFormData) {
                return core.ajax('POST', url, args, isFormData);
            },
            'put': function (args, isFormData) {
                return core.ajax('PUT', url, args, isFormData);
            },
            'delete': function (args) {
                return core.ajax('DELETE', url, args);
            }
        };

    }

    if (typeof window !== 'undefined') {
        window.$http = $http;
    }
    if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
        module.exports = $http;
    }

})(window);


(function () {

    var helper = (function (window, undefined) {


        //Returns true if it is a DOM node
        function isNode(o) {
            return (
                typeof Node === "object" ? o instanceof Node :
                    o && typeof o === "object" && typeof o.nodeType === "number" && typeof o.nodeName === "string"
            );
        }

        function isWindow(o) {
            return (
                Object.prototype.toString.call(o) === "[object Window]" ||
                Object.prototype.toString.call(o) === "[object global]"
            );

        }


//Returns true if it is a DOM element
        function isElement(o) {
            return (
                typeof HTMLElement === "object" ? o instanceof HTMLElement : //DOM2
                    o && typeof o === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string"
            );
        }


        function HTMLForForeach(objs) {
            if (
                isNode(objs) || isWindow(objs)
            ) {
                if (objs.length <= 1 || isWindow(objs)) {
                    objs = [objs];
                }
            }

            if (isElement(objs)) {
                objs = [objs];
            }
            if (objs == null) {
                return false;
            }
            if (typeof objs && typeof objs.length === "undefined") {
                objs = [objs];
            }

            return objs;
        }
        /**
         * Ajouter un ou plusieurs evenement
         * @param {type} obj
         * @param {type} evts
         * @param {type} handler
         * @returns {undefined}
         */
        function on(objs, events, handler) {

            objs = HTMLForForeach(objs);
            objs.forEach(function (obj) {
                var t, evt, evts = events;
                // on verifie si il y a plusieurs élements
                evts = (evts || "").match(/\S+/g) || [""];
                // on les comptes
                t = evts.length;
                // On créé chaque évenement un par un
                while (t--) {
                    evt = evts[t];
                    if (obj.addEventListener) {
                        // W3C method
                        obj.addEventListener(evt, handler, false);
                    } else if (obj.attachEvent) {
                        // IE method.
                        obj.attachEvent('on' + evt, handler);
                    } else {
                        // Old school method.
                        obj['on' + evt] = handler;
                    }
                }
            })
        }

        /*
         * Ajouter un ou plusieurs evenement
         */
        function off(obj, evts, handler) {
            var t, evt;
            // on verifie si il y a plusieurs élements
            evts = (evts || "").match(/\S+/g) || [""];
            // on les comptes
            t = evts.length;
            // On créé chaque évenement un par un
            while (t--) {
                evt = evts[t];
                if (obj.removeEventListener) {
                    obj.removeEventListener(evt, handler, false);
                }
                if (obj.detachEvent) {
                    obj.detachEvent('on' + evt, handler);
                }
            }
        }

        // create a one-time event
        function one(el, type, fn) {
            function handler(event) {
                off(el, type, handler);
                fn(event);
            }

            on(el, type, handler);
        }

        function fireEvent(obj, evts) {
            var t, evt;
            // on verifie si il y a plusieurs élements
            evts = (evts || "").match(/\S+/g) || [""];
            // on les comptes
            t = evts.length;
            // On créé chaque évenement un par un
            while (t--) {
                evt = evts[t];
                if (typeof Event === 'function' || !document.fireEvent) {
                    var event = document.createEvent('HTMLEvents');
                    event.initEvent(evt, true, true);
                    obj.dispatchEvent(event);
                } else {
                    obj.fireEvent('on' + evt);
                }
            }
        }

// explicitly return public methods when this object is instantiated
        return {
            on: on,
            off: off,
            one: one,
            fireEvent: fireEvent,
        };

    })(window);


    if (typeof window !== 'undefined') {
        window.LOW = helper;
    }
    if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
        module.exports = helper;
    }


})();
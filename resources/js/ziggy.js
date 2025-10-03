const Ziggy = {
    "url": "http:\/\/localhost:8000", "port": 8000, "defaults": {}, "routes": {
        "sanctum.csrf-cookie": { "uri": "sanctum\/csrf-cookie", "methods": ["GET", "HEAD"] },
        "dashboard": { "uri": "dashboard", "methods": ["GET", "HEAD"] },
        "profile.edit": { "uri": "profile", "methods": ["GET", "HEAD"] },
        "profile.update": { "uri": "profile", "methods": ["PATCH"] },
        "profile.destroy": { "uri": "profile", "methods": ["DELETE"] },
        "register": { "uri": "register", "methods": ["GET", "HEAD"] },
        "login": { "uri": "login", "methods": ["GET", "HEAD"] },
        "password.request": { "uri": "forgot-password", "methods": ["GET", "HEAD"] },
        "password.email": { "uri": "forgot-password", "methods": ["POST"] },
        "password.reset": { "uri": "reset-password\/{token}", "methods": ["GET", "HEAD"], "parameters": ["token"] },
        "password.store": { "uri": "reset-password", "methods": ["POST"] },
        "verification.notice": { "uri": "verify-email", "methods": ["GET", "HEAD"] },
        "verification.verify": {
            "uri": "verify-email\/{id}\/{hash}",
            "methods": ["GET", "HEAD"],
            "parameters": ["id", "hash"]
        },
        "verification.send": { "uri": "email\/verification-notification", "methods": ["POST"] },
        "password.confirm": { "uri": "confirm-password", "methods": ["GET", "HEAD"] },
        "password.update": { "uri": "password", "methods": ["PUT"] },
        "logout": { "uri": "logout", "methods": ["POST"] },
        "cemeteries.index": { "uri": "cemeteries", "methods": ["GET", "HEAD"] },
        "cemeteries.create": { "uri": "cemeteries\/create", "methods": ["GET", "HEAD"] },
        "cemeteries.store": { "uri": "cemeteries", "methods": ["POST"] },
        "cemeteries.show": {
            "uri": "cemeteries\/{cemetery}",
            "methods": ["GET", "HEAD"],
            "parameters": ["cemetery"],
            "bindings": { "cemetery": "id" }
        },
        "cemeteries.edit": {
            "uri": "cemeteries\/{cemetery}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["cemetery"],
            "bindings": { "cemetery": "id" }
        },
        "cemeteries.update": {
            "uri": "cemeteries\/{cemetery}",
            "methods": ["PUT", "PATCH"],
            "parameters": ["cemetery"],
            "bindings": { "cemetery": "id" }
        },
        "cemeteries.destroy": {
            "uri": "cemeteries\/{cemetery}",
            "methods": ["DELETE"],
            "parameters": ["cemetery"],
            "bindings": { "cemetery": "id" }
        },
        "graves.index": { "uri": "graves", "methods": ["GET", "HEAD"] },
        "graves.create": { "uri": "graves\/create", "methods": ["GET", "HEAD"] },
        "graves.store": { "uri": "graves", "methods": ["POST"] },
        "graves.show": {
            "uri": "graves\/{grave}",
            "methods": ["GET", "HEAD"],
            "parameters": ["grave"],
            "bindings": { "grave": "id" }
        },
        "graves.edit": {
            "uri": "graves\/{grave}\/edit",
            "methods": ["GET", "HEAD"],
            "parameters": ["grave"],
            "bindings": { "grave": "id" }
        },
        "graves.update": {
            "uri": "graves\/{grave}",
            "methods": ["PUT", "PATCH"],
            "parameters": ["grave"],
            "bindings": { "grave": "id" }
        },
        "graves.destroy": {
            "uri": "graves\/{grave}",
            "methods": ["DELETE"],
            "parameters": ["grave"],
            "bindings": { "grave": "id" }
        },
        "persons.index": { "uri": "persons", "methods": ["GET", "HEAD"] },
        "persons.create": { "uri": "persons\/create", "methods": ["GET", "HEAD"] },
        "persons.store": { "uri": "persons", "methods": ["POST"] },
        "persons.show": {
            "uri": "persons\/{person}",
            "methods": ["GET", "HEAD"],
            "parameters": ["person"],
            "bindings": { "person": "id" }
        },
        "persons.edit": { "uri": "persons\/{person}\/edit", "methods": ["GET", "HEAD"], "parameters": ["person"] },
        "persons.update": { "uri": "persons\/{person}", "methods": ["PUT", "PATCH"], "parameters": ["person"] },
        "persons.destroy": { "uri": "persons\/{person}", "methods": ["DELETE"], "parameters": ["person"] },
        "storage.local": {
            "uri": "storage\/{path}",
            "methods": ["GET", "HEAD"],
            "wheres": { "path": ".*" },
            "parameters": ["path"]
        }
    }
};
if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

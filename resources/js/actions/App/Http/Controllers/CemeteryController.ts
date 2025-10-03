import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\CemeteryController::index
 * @see app/Http/Controllers/CemeteryController.php:18
 * @route '/cemeteries'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/cemeteries',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CemeteryController::index
 * @see app/Http/Controllers/CemeteryController.php:18
 * @route '/cemeteries'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::index
 * @see app/Http/Controllers/CemeteryController.php:18
 * @route '/cemeteries'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CemeteryController::index
 * @see app/Http/Controllers/CemeteryController.php:18
 * @route '/cemeteries'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CemeteryController::create
 * @see app/Http/Controllers/CemeteryController.php:42
 * @route '/cemeteries/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/cemeteries/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CemeteryController::create
 * @see app/Http/Controllers/CemeteryController.php:42
 * @route '/cemeteries/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::create
 * @see app/Http/Controllers/CemeteryController.php:42
 * @route '/cemeteries/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CemeteryController::create
 * @see app/Http/Controllers/CemeteryController.php:42
 * @route '/cemeteries/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CemeteryController::store
 * @see app/Http/Controllers/CemeteryController.php:50
 * @route '/cemeteries'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/cemeteries',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\CemeteryController::store
 * @see app/Http/Controllers/CemeteryController.php:50
 * @route '/cemeteries'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::store
 * @see app/Http/Controllers/CemeteryController.php:50
 * @route '/cemeteries'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\CemeteryController::show
 * @see app/Http/Controllers/CemeteryController.php:60
 * @route '/cemeteries/{cemetery}'
 */
export const show = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/cemeteries/{cemetery}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CemeteryController::show
 * @see app/Http/Controllers/CemeteryController.php:60
 * @route '/cemeteries/{cemetery}'
 */
show.url = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { cemetery: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { cemetery: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    cemetery: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        cemetery: typeof args.cemetery === 'object'
                ? args.cemetery.id
                : args.cemetery,
                }

    return show.definition.url
            .replace('{cemetery}', parsedArgs.cemetery.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::show
 * @see app/Http/Controllers/CemeteryController.php:60
 * @route '/cemeteries/{cemetery}'
 */
show.get = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CemeteryController::show
 * @see app/Http/Controllers/CemeteryController.php:60
 * @route '/cemeteries/{cemetery}'
 */
show.head = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CemeteryController::edit
 * @see app/Http/Controllers/CemeteryController.php:68
 * @route '/cemeteries/{cemetery}/edit'
 */
export const edit = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/cemeteries/{cemetery}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\CemeteryController::edit
 * @see app/Http/Controllers/CemeteryController.php:68
 * @route '/cemeteries/{cemetery}/edit'
 */
edit.url = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { cemetery: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { cemetery: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    cemetery: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        cemetery: typeof args.cemetery === 'object'
                ? args.cemetery.id
                : args.cemetery,
                }

    return edit.definition.url
            .replace('{cemetery}', parsedArgs.cemetery.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::edit
 * @see app/Http/Controllers/CemeteryController.php:68
 * @route '/cemeteries/{cemetery}/edit'
 */
edit.get = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\CemeteryController::edit
 * @see app/Http/Controllers/CemeteryController.php:68
 * @route '/cemeteries/{cemetery}/edit'
 */
edit.head = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\CemeteryController::update
 * @see app/Http/Controllers/CemeteryController.php:78
 * @route '/cemeteries/{cemetery}'
 */
export const update = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/cemeteries/{cemetery}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\CemeteryController::update
 * @see app/Http/Controllers/CemeteryController.php:78
 * @route '/cemeteries/{cemetery}'
 */
update.url = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { cemetery: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { cemetery: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    cemetery: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        cemetery: typeof args.cemetery === 'object'
                ? args.cemetery.id
                : args.cemetery,
                }

    return update.definition.url
            .replace('{cemetery}', parsedArgs.cemetery.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::update
 * @see app/Http/Controllers/CemeteryController.php:78
 * @route '/cemeteries/{cemetery}'
 */
update.put = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\CemeteryController::update
 * @see app/Http/Controllers/CemeteryController.php:78
 * @route '/cemeteries/{cemetery}'
 */
update.patch = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\CemeteryController::destroy
 * @see app/Http/Controllers/CemeteryController.php:87
 * @route '/cemeteries/{cemetery}'
 */
export const destroy = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/cemeteries/{cemetery}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\CemeteryController::destroy
 * @see app/Http/Controllers/CemeteryController.php:87
 * @route '/cemeteries/{cemetery}'
 */
destroy.url = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { cemetery: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { cemetery: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    cemetery: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        cemetery: typeof args.cemetery === 'object'
                ? args.cemetery.id
                : args.cemetery,
                }

    return destroy.definition.url
            .replace('{cemetery}', parsedArgs.cemetery.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\CemeteryController::destroy
 * @see app/Http/Controllers/CemeteryController.php:87
 * @route '/cemeteries/{cemetery}'
 */
destroy.delete = (args: { cemetery: string | { id: string } } | [cemetery: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})
const CemeteryController = { index, create, store, show, edit, update, destroy }

export default CemeteryController
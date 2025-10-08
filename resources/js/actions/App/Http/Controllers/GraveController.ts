import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\GraveController::index
 * @see app/Http/Controllers/GraveController.php:18
 * @route '/graves'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/graves',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\GraveController::index
 * @see app/Http/Controllers/GraveController.php:18
 * @route '/graves'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::index
 * @see app/Http/Controllers/GraveController.php:18
 * @route '/graves'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\GraveController::index
 * @see app/Http/Controllers/GraveController.php:18
 * @route '/graves'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\GraveController::create
 * @see app/Http/Controllers/GraveController.php:50
 * @route '/graves/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/graves/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\GraveController::create
 * @see app/Http/Controllers/GraveController.php:50
 * @route '/graves/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::create
 * @see app/Http/Controllers/GraveController.php:50
 * @route '/graves/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\GraveController::create
 * @see app/Http/Controllers/GraveController.php:50
 * @route '/graves/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\GraveController::store
 * @see app/Http/Controllers/GraveController.php:63
 * @route '/graves'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/graves',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\GraveController::store
 * @see app/Http/Controllers/GraveController.php:63
 * @route '/graves'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::store
 * @see app/Http/Controllers/GraveController.php:63
 * @route '/graves'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\GraveController::show
 * @see app/Http/Controllers/GraveController.php:72
 * @route '/graves/{grave}'
 */
export const show = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/graves/{grave}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\GraveController::show
 * @see app/Http/Controllers/GraveController.php:72
 * @route '/graves/{grave}'
 */
show.url = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { grave: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { grave: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    grave: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        grave: typeof args.grave === 'object'
                ? args.grave.id
                : args.grave,
                }

    return show.definition.url
            .replace('{grave}', parsedArgs.grave.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::show
 * @see app/Http/Controllers/GraveController.php:72
 * @route '/graves/{grave}'
 */
show.get = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\GraveController::show
 * @see app/Http/Controllers/GraveController.php:72
 * @route '/graves/{grave}'
 */
show.head = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\GraveController::edit
 * @see app/Http/Controllers/GraveController.php:80
 * @route '/graves/{grave}/edit'
 */
export const edit = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/graves/{grave}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\GraveController::edit
 * @see app/Http/Controllers/GraveController.php:80
 * @route '/graves/{grave}/edit'
 */
edit.url = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { grave: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { grave: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    grave: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        grave: typeof args.grave === 'object'
                ? args.grave.id
                : args.grave,
                }

    return edit.definition.url
            .replace('{grave}', parsedArgs.grave.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::edit
 * @see app/Http/Controllers/GraveController.php:80
 * @route '/graves/{grave}/edit'
 */
edit.get = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\GraveController::edit
 * @see app/Http/Controllers/GraveController.php:80
 * @route '/graves/{grave}/edit'
 */
edit.head = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\GraveController::update
 * @see app/Http/Controllers/GraveController.php:90
 * @route '/graves/{grave}'
 */
export const update = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/graves/{grave}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\GraveController::update
 * @see app/Http/Controllers/GraveController.php:90
 * @route '/graves/{grave}'
 */
update.url = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { grave: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { grave: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    grave: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        grave: typeof args.grave === 'object'
                ? args.grave.id
                : args.grave,
                }

    return update.definition.url
            .replace('{grave}', parsedArgs.grave.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::update
 * @see app/Http/Controllers/GraveController.php:90
 * @route '/graves/{grave}'
 */
update.put = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\GraveController::update
 * @see app/Http/Controllers/GraveController.php:90
 * @route '/graves/{grave}'
 */
update.patch = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\GraveController::destroy
 * @see app/Http/Controllers/GraveController.php:99
 * @route '/graves/{grave}'
 */
export const destroy = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/graves/{grave}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\GraveController::destroy
 * @see app/Http/Controllers/GraveController.php:99
 * @route '/graves/{grave}'
 */
destroy.url = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { grave: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { grave: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    grave: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        grave: typeof args.grave === 'object'
                ? args.grave.id
                : args.grave,
                }

    return destroy.definition.url
            .replace('{grave}', parsedArgs.grave.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\GraveController::destroy
 * @see app/Http/Controllers/GraveController.php:99
 * @route '/graves/{grave}'
 */
destroy.delete = (args: { grave: string | { id: string } } | [grave: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})
const GraveController = { index, create, store, show, edit, update, destroy }

export default GraveController
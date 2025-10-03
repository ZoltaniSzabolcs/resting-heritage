import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PersonController::index
 * @see app/Http/Controllers/PersonController.php:20
 * @route '/persons'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/persons',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PersonController::index
 * @see app/Http/Controllers/PersonController.php:20
 * @route '/persons'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::index
 * @see app/Http/Controllers/PersonController.php:20
 * @route '/persons'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PersonController::index
 * @see app/Http/Controllers/PersonController.php:20
 * @route '/persons'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PersonController::create
 * @see app/Http/Controllers/PersonController.php:44
 * @route '/persons/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/persons/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PersonController::create
 * @see app/Http/Controllers/PersonController.php:44
 * @route '/persons/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::create
 * @see app/Http/Controllers/PersonController.php:44
 * @route '/persons/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PersonController::create
 * @see app/Http/Controllers/PersonController.php:44
 * @route '/persons/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PersonController::store
 * @see app/Http/Controllers/PersonController.php:56
 * @route '/persons'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/persons',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PersonController::store
 * @see app/Http/Controllers/PersonController.php:56
 * @route '/persons'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::store
 * @see app/Http/Controllers/PersonController.php:56
 * @route '/persons'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\PersonController::show
 * @see app/Http/Controllers/PersonController.php:65
 * @route '/persons/{person}'
 */
export const show = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/persons/{person}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PersonController::show
 * @see app/Http/Controllers/PersonController.php:65
 * @route '/persons/{person}'
 */
show.url = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { person: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { person: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    person: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        person: typeof args.person === 'object'
                ? args.person.id
                : args.person,
                }

    return show.definition.url
            .replace('{person}', parsedArgs.person.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::show
 * @see app/Http/Controllers/PersonController.php:65
 * @route '/persons/{person}'
 */
show.get = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PersonController::show
 * @see app/Http/Controllers/PersonController.php:65
 * @route '/persons/{person}'
 */
show.head = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PersonController::edit
 * @see app/Http/Controllers/PersonController.php:73
 * @route '/persons/{person}/edit'
 */
export const edit = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/persons/{person}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PersonController::edit
 * @see app/Http/Controllers/PersonController.php:73
 * @route '/persons/{person}/edit'
 */
edit.url = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { person: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { person: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    person: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        person: typeof args.person === 'object'
                ? args.person.id
                : args.person,
                }

    return edit.definition.url
            .replace('{person}', parsedArgs.person.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::edit
 * @see app/Http/Controllers/PersonController.php:73
 * @route '/persons/{person}/edit'
 */
edit.get = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PersonController::edit
 * @see app/Http/Controllers/PersonController.php:73
 * @route '/persons/{person}/edit'
 */
edit.head = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\PersonController::update
 * @see app/Http/Controllers/PersonController.php:83
 * @route '/persons/{person}'
 */
export const update = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/persons/{person}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\PersonController::update
 * @see app/Http/Controllers/PersonController.php:83
 * @route '/persons/{person}'
 */
update.url = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { person: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { person: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    person: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        person: typeof args.person === 'object'
                ? args.person.id
                : args.person,
                }

    return update.definition.url
            .replace('{person}', parsedArgs.person.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::update
 * @see app/Http/Controllers/PersonController.php:83
 * @route '/persons/{person}'
 */
update.put = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\PersonController::update
 * @see app/Http/Controllers/PersonController.php:83
 * @route '/persons/{person}'
 */
update.patch = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\PersonController::destroy
 * @see app/Http/Controllers/PersonController.php:94
 * @route '/persons/{person}'
 */
export const destroy = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/persons/{person}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\PersonController::destroy
 * @see app/Http/Controllers/PersonController.php:94
 * @route '/persons/{person}'
 */
destroy.url = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { person: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { person: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    person: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        person: typeof args.person === 'object'
                ? args.person.id
                : args.person,
                }

    return destroy.definition.url
            .replace('{person}', parsedArgs.person.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\PersonController::destroy
 * @see app/Http/Controllers/PersonController.php:94
 * @route '/persons/{person}'
 */
destroy.delete = (args: { person: string | { id: string } } | [person: string | { id: string } ] | string | { id: string }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})
const PersonController = { index, create, store, show, edit, update, destroy }

export default PersonController
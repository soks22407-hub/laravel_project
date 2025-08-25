Route::get('/users', function () {
    return 'List of users';
});                                                                                                                                                                            Route::post('/users', function () {
    return 'User created';
});                                                                                                                                                                               Route::put('/users/{id}', function ($id) {
    return \"User {$id} updated (full)\";
});                                                                                                                                                                               Route::patch('/users/{id}', function ($id) {
    return \"User {$id} updated (partial)\";                                                                                                                                                      Route::delete('/users/{id}', function ($id) {
    return \"User {$id} deleted\";
}); 
});
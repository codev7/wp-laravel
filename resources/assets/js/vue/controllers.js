export default {
    'portfolio': require('./controllers/portfolio'),
    'cmv-jobs': require('./controllers/cmv-jobs'),

    'admin/project-modal': require('./controllers/admin/project-modal'),

    'project/briefs': require('./controllers/project/briefs'),
    'project/brief-view': require('./controllers/project/brief-view'),
    'project/brief-edit': require('./controllers/project/brief-edit'),
    'project/dashboard': require('./controllers/project/dashboard'),
    'project/files': require('./controllers/project/files'),
    'project/invoices': require('./controllers/project/invoices'),
    'project/todos': require('./controllers/project/todos'),
    'project/todo': require('./controllers/project/todo'),
    'project/new': require('./controllers/project/new'),
    'project/team': require('./controllers/project/team'),
    'project/news': require('./controllers/project/news'),

    'misc/uploadcare': require('./controllers/misc/uploadcare'),
    'register/invitation': require('./controllers/register/invitation')
};
{
  "modals_item": {
    "name": "New Modal",
    "summary": "",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ],
    "design_proofs": [
      {{-- blanks.design_proofs_item --}}
    ],
    "design_file_id": "" {{-- id of the file in files table where the full design file exists for the view --}}
  },

  "views_item": {
    "name": "New View",
    "summary": "",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ],
    "design_proofs": [
      {{-- blanks.design_proof_item --}}
    ],
    "design_file_id": "" {{-- id of the file in files table where the full design file exists for the view --}}
  },

  "brief_boxes_item": {
    "title": "New Brief Box",
    "description": "",
    "tooltip": ""
  },

  "sections_item": {
    "name": "New Section",
    "summary": "",
    "sub_sections": [
      {{-- sub_sections_item --}}
    ]
  },

  "sub_sections_item": {
    "header": "New Sub Section",
    "content": "",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ]
  },

  "checklist_item": {
    "category": "design",
    "text": "",
    "screenshots": []
  },

  "design_proofs_item": {
    "name": "",
    "screenshot_url": []
  },

  "post_types_item": {
    "name": "New Post Type",
    "summary": "",
    "has_single_post_page": true,
    "view_for_single_post_page": "", {{-- name of view that the single post page should use, this can be null if has_single_post_page=false --}}
    "include_in_search": true, {{-- user can define whether or not this CPT shows up in search results on the site --}}
    "has_archive": true, {{-- user can define whether this CPT has an archives page that displays all of the post types in a feed --}}
    "view_for_post_archive_page": "", {{-- name of view that single post page should use, this comes from the associated front end brief --}}
    "meta_data": ["wp_title", "content_wysiwyg", "menu_order", "thumbnail"],
    "custom_meta_fields": [
      {{-- blanks.custom_meta_fields_item --}}
    ],
    "taxonomies": [
      {{-- blanks.custom_taxonomies_item --}}
    ]
  },

  "custom_meta_fields_item": {
    "name": "",
    "type": "text",
    "required": false
  },

  "taxonomies_item": {
    "name": ""
  },

  "endpoints_item": {
    "name": "New Endpoint",
    "summary": "",
    "form_inputs": "",
    "expected_output_action": ""
  },

  "templates_item": {
    "name": "New Template",
    "summary": "",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ],
    "front_end_brief_view_name": "" {{-- name of the view from the associated front end brief that this WP template will use, the design proofs are also automatically pulled in from this association. --}}
  },

  "theme_menus_item": {
    "name": "New Theme Menu",
    "description": ""
  },

  "menu_items_item": {
     "header": "Menu Header",
     "content": "",
     "checklist": []
  },

  "select": {
    "checklist_item_categories": [
      {"text": "design", "value": "design"},
      {"text": "html/css", "value": "html/css"},
      {"text": "javascript", "value": "javascript"},
      {"text": "animations", "value": "animations"}
    ],
    "layout_types": [
      {"text": "responsive", "value": "responsive"},
      {"text": "fixed", "value": "fixed"},
      {"text": "mobile only", "value": "mobile-only"},
      {"text": "fluid", "value": "fluid"}
    ],
    "brief_types": [
      {"text": "frontend", "value": "frontend"},
      {"text": "wordpress", "value": "wordpress"},
      {"text": "other", "value": "other"}
    ],
    "meta_data": [
      {"text": "author", "value": "author"},
      {"text": "wp_title", "value": "wp_title"},
      {"text": "content_wysiwyg", "value": "content_wysiwyg"},
      {"text": "excerpt", "value": "excerpt"},
      {"text": "menu_order", "value": "menu_order"},
      {"text": "thumbnail", "value": "thumbnail"}
    ],
    "meta_field_types": [
      {"text": "text", "value": "text"},
      {"text": "textarea", "value": "textarea"},
      {"text": "file", "value": "file"},
      {"text": "image", "value": "image"},
      {"text": "repeater", "value": "repeater"}
    ]
  }
}
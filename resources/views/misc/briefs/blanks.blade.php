{
  "modals_item": {
    "name": "Contact Us Form",
    "summary": "Here is a quick summary of the modal.",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ],
    "design_proofs": [
      {{-- blanks.design_proofs_item --}}
    ],
    "design_file_id": "" {{-- id of the file in files table where the full design file exists for the view --}}
  },

  "views_item": {
    "name": "Name of the view",
    "summary": "Here is a quick summary of the view.",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ],
    "design_proofs": [
      {{-- blanks.design_proof_item --}}
    ],
    "design_file_id": "" {{-- id of the file in files table where the full design file exists for the view --}}
  },

  "brief_boxes_item": {
    "title": "Box Title",
    "description": "Box description",
    "tooltip": "Box tooltip content here"
  },

  "sections_item": {
    "name": "Home",
    "summary": "Here is a quick summary of the view.",
    "sub_sections": [
      {{-- sub_sections_item --}}
    ]
  },

  "sub_sections_item": {
    "header": "Sub Section Menu Header",
    "content": "wysiwyg html content here",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ]
  },

  "checklist_item": {
    "category": "design",
    "text": "The text associated with the checklist item",
    "screenshots": ["http://srcnsht.my/SCjk2ct", "http://srcnsht.my/SCjk2ct"]
  },

  "design_proofs_item": {
    "name": "",
    "screenshot_url": []
  },

  "post_types_item": {
    "name": "Testimonials",
    "summary": "Here is a quick summary of the post type.",
    "has_single_post_page": true,
    "view_for_single_post_page": "", {{-- name of view that the single post page should use, this can be null if has_single_post_page=false --}}
    "include_in_search": true, {{-- user can define whether or not this CPT shows up in search results on the site --}}
    "has_archive": true, {{-- user can define whether this CPT has an archives page that displays all of the post types in a feed --}}
    "view_for_post_archive_page": "", {{-- name of view that single post page should use, this comes from the associated front end brief --}}
    "meta_data_defaults": {
      "author": false,
      "wp_title": true,
      "content_wysiwyg": true,
      "excerpt": false,
      "menu_order": true,
      "thumbnail": true
    },
    "custom_meta_fields": [
      {{-- blanks.custom_meta_fields_item --}}
    ],
    "taxonomies": [
      {{-- blanks.custom_taxonomies_item --}}
    ]
  },

  "custom_meta_fields_item": {
    "name": "Testimonial Quote By",
    "type": "text",
    "required": false
  },

  "taxonomies_item": {
    "name": ""
  },

  "endpoints_item": {
    "name": "Contact Form",
    "summary": "Here is a quick summary of the endpoint with expected functionality outlined.",
    "form_inputs": "This is a markdown text with a description of what the user is submitting.",
    "expected_output_action": "This is a markdown text with a description of what happens after a user submits."
  },

  "templates_item": {
    "name": "Home",
    "summary": "Here is a quick summary of the view.",
    "checklist": [
      {{-- blanks.checklist_item --}}
    ],
    "front_end_brief_view_name": "" {{-- name of the view from the associated front end brief that this WP template will use, the design proofs are also automatically pulled in from this association. --}}
  },

  "theme_menus_item": {
    "name": "Header Menu",
    "description": "the menu in the header of every page"
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
    ]
  }
}
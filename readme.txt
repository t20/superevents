=== Plugin Name ===
Contributors: teraom
Donate link: http://teraom.com/donate
Tags: events, rsvp, meetings
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: trunk

Super Events is an event management plugin with RSVP. 

== Description ==

Super events does two major things.

1. Creates an event type, as a custom post type. There is also a type taxonomy associated with the event post type. This will help you categorize events by type - E.g. weekly meeting, Special events, Guest speakers, etc.

2. Creates a sidebar widget for RSVP. You can drag this widget to any of your sidebars. This widget will appear ONLY on event type pages. The widget allows the user to enter a response (yes, no, may be) if logged in, else points a link to login/register. If the user has already set a RSVP, the user may update it here too.

== Installation ==

This section describes how to install the plugin and get it working.

1. On your admin dashboard, click on "Plugins". Click on "Add New". Search for "superevents". On the search results page, click "Install Now".

 If you prefer the manual way, you can also download the superevents plugin, unzip it and upload `super-events` folder to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress
3. You will now see 'EVENTS' post type below comments in your dashboard. You can create as many events as you want. You can also categorize events by type.
4. Go to Appearance -> Widgets. You will see the RSVP widget. Add this widget to your sidebar, configure it. The widget appears only on event pages.

5. (OPTIONAL STEP) If you want more control over CSS:
Copy superevents.css from the superevents/css folder, paste it to your theme folder and override the values. Note: If you do so, the css file in the superevents/css folder ll not be loaded. In any case, only one of the stylesheets is loaded. All element IDs and Classes have superevents as a prefix.

6. (OPTIONAL STEP) if you want more control over the template:
In your theme directory, make a copy of single.php, rename it to 'single-event.php'. 
This template ll be picked up for all single event type pages instead. 
You may also want to overload taxonomy 'type' if required with a custom template.
Please try to reuse CSS by adding superevents prefix in all your elements.

== Frequently Asked Questions ==

= How can see the headcount for an event? =

You will see the headcount of an event, based on RSVP, in your dashboard events page. 

= Can I configure the RSVP values? =

This will be available in a future release.

== Screenshots ==

1. Add Event Page
2. Events page with Headcount
3. RSVP to an event

== Changelog ==

= 0.2 =
* More detailed installation instructions
* Tested with newer versions of wordpress

= 0.1 =
* First version

== Upgrade Notice ==

= 0.1 =
* Not applicable.

== Feedback ==

This is my first wordpress plugin. If you have any questions, comments, ideas, feedback, I would love to hear from you. If you would like to share an idea for a plugin, or need help with building your plugin, please feel free to reach me.
Reach me at - [[star at bharad dot net]]
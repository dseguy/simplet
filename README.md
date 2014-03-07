# Simplet
Simplet is a simple, file-based, cms framework written in php, with members, forums, and blogging built in.

# It's not finished yet.

## Features
- Responsive Layout
- Server Side
	- Nginx Compatible
	- PHP 5.3+
	- MySQL and MariaDB Tested
- Members
	- Signup
	- Login
	- Logout
	- Session Listing
	- Session Termination
	- Change Name
	- Change Mail
	- Change Pass
	- Reset Pass
- Forums
	- Categories
	- Topics
	- SEO Friendly Slugs
	- Markdown Posts
- File-Based Blog
	- Categories
	- Trending Posts
- Open Source
- Quotes Douglas Adams

## Roadmap

### Version 4
- Global
	- Move to more popular [Google Fonts](//fonts.googleapis.com/css?family=Open+Sans300,400|Droid+Sans:400,700|Droid+Serif:400,700,400italic,700italic)
	- Update Legal
- Admin Interface
	- User Management
		- Edit/Lock/Delete
		- Mail
		- Reset Pass
	- Forum
		- Create/Edit/Private/Hide/Lock/Delete Categories
		- Edit/Private/Hide/Lock/Delete Topics
	- Responses Edit/Hide/Delete
- Backend
	- Feeds
		- Topics
		- Responses
		- Replies
	- Sitemaps
		- Recursive (only one needed)
		- Forum Categories
		- Forum Topics
		- Responses
- Configuration
	- Move Database Config to `once.connect.php` (?)
	- Move Remaining to Database
- Forum
	- Category and Topic Pagination
	- Unread, Read Icon
	- Most Recent
	- Fix Home with Trailing Slash
	- Improve Category Error
	- Uniqueness Check Topic Slug
- Responses
	- Make Submit un-clickable to prevent double-posts.
	- Show Error on Error (and Re-instate Submit).
	- Clear (Reset) Form and Re-instate Submit.
	- Order by Helpfulness, Replies and Time (both ways)
	- Configuration Option for Time Locking
	- Change Helpfulness API to JSON
	- Replies
	- Fix Quotes on JSON Response
- Security Limits
	- Time-and-Attempt-based
	- Option of System
		- Captcha
		- SweetCaptcha
		- English (?)
		- Maths (?)
		- Block
	- Signups
	- Logins
	- Resets
	- Forum Topics
	- Responses
	- Replies
- Trending
	- Add Topics and Category Title Fetching
	- Add to API and return as JSON
- User Accounts
	- More Lenient Sessions (First half of IP match, Waning: IPv6)
	- Delete Option
	- Fix Password Resets
	- Redirect to previous on login.

### Future
- User Accounts
	- User Profiles
	- Inter-User Messaging
- Database-Driven Blog
- Apache Config File (with Extensionless PHP)

## Libraries

### PHP
- [Browning (0.23)](https://github.com/eustasy/browning-a-mailgun-script)
- [Parsedown (0.9.4)](https://github.com/erusev/parsedown)
- [Recaptcha (1.11)](https://www.google.com/recaptcha/admin)
- [Sweet Captcha (1.1.0)](http://sweetcaptcha.com/)

### CSS
- [HTML5 Reset (30/11/13)](https://github.com/murtaugh/HTML5-Reset)

### JavaScript
- [Selectivizr](https://github.com/keithclark/selectivizr)
- [Modernizr](http://modernizr.com/download/#-fontface-backgroundsize-borderradius-opacity-rgba-generatedcontent-csstransitions-printshiv-mq-teststyles-testprop-testallprops-prefixes-domprefixes)
- [jQuery](http://jquery.com/)
- [jQuery.equalize](http://labs.eustasy.org/jquery.equalize)
- [jQuery Cookie](https://github.com/carhartl/jquery-cookie)

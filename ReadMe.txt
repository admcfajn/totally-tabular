Totally Tabular - Responsive Tabbed Widget WordPress plugin

Installation Guide:

	1. Activate Plugin
	2. Visit Appearance >> Widgets & Add widgets to 'Tabular Sidebar'
	3. Use [tabular] shortcode Tabular-Sidebar in your WordPress theme, posts or pages.
	4. Tabs will cycle automatically & switch between tabs when clicked.
	5. Visit: Settings >> Totally Tabular to change speed & layout settings
	
Future Releases to Include:

	- Multiple tabbed areas
	- Multiple copies of each tabbed area on a single-page
	- CSS Refinements & Style switching
	- Gooder Working Code.
	
Footnotes:
As of right now the whole tabbed-area is css position:relative and the tabbed content-areas position:absolute. This is because the widgets are output in a title1,content1,title2,content2 sequence.

I had to position the content areas a fixed amount from the top of their container to make room for the tabs / links… Any other configuration results tab/content/tab/content… Rather than tab/tab/rotating-content.

Ideally I would like to see them output in title1,title2,title3 – content1,content2,content3 sequences so I could avoid using absolute-positioning which may not display where expected in some themes.

It’s one thing to filter the widget titles… But I’m finding filtering the content output with each widget to be difficult, as there is no one way to format widget-content, and thus no one-way to filter them all to behave in this custom-formatted sidebar. If you find bugs or can suggest improvements please


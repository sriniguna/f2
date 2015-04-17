Internationalization
====================

Translation credits
-------------------

Code     Language               Translator
-----------------------------------------------
be_BY    Belorussian            Marcis G.
bg_BG    Bulgarian              Vladimir Borisov
da_DK    Danish                 Per Lundbech
de_DE    German                 Stephan Jaschke
es_ES    Spanish                Jesús Diéguez Fernández
fa_IR    Persian                Ghiasabadi R. M.
fo_FO    Faroese                Hjalti á Lava
fr_FR    French                 Etienne
hi_IN    Hindi                  Ashish Jha
id_ID    Indonesian             Masino Sinaga
it_IT    Italian                Gianni Diurno (aka gidibao)
ja       Japanese               Mako
lt_LT    Lithuanian             Tomas Šiurna
lv       Latvian                Johannes Rau
nb_NO    Norwegian (Bokmål)     Eilif Nordseth, Eivind Ødegård
nl_NL    Dutch                  R. Helmes
nn_NO    Norwegian (Nynorsk)    Eivind Ødegård
pl_PL    Polish                 Super Grey
pt_BR    Portugese              Pedro Padron
ru_RU    Russian                Mihail Pomaskin
sk_SK    Slovak                 Nikola Garajov
ta       Tamil                  Ravi
tr_TR    Turkish                Caner Güral
uk_UA    Ukrainian              Oleg Tsvirko
zh_CN    Chinese                Awu
zh_TW    Traditional Chinese    Mingyao Chuang


Translating the Theme
---------------------

1. Fetch the translation template file named `f2.pot` from the `languages` directory. Open it.
2. Translate the strings in your language, provide other details and save it as a 'po' file. The file should be named in the format `xx_YY.po`, where xx refers to the language code and YY to the locale. For example, the German po file will have the name `de_DE.po`. This xx_YY should be the same as the value you define for WPLANG in wp-config.php.
3. Create an 'mo' file based on your 'po' file using the [GNU gettext utility](http://www.gnu.org/software/gettext/gettext.html), and name it in the format `xx_YY.mo` similar to your 'po' file.
4. The 'po' and 'mo' files should go in the `languages` directory of the theme. If WPLANG is set in wp-config.php, your site will should show the translated strings instead of the original strings.

Instead of manually editing the 'po' file and generating an 'mo' file, you can use an application like [poEdit](http://www.poedit.net/).

If you wish to share your translation, send the files to the theme author (srinig.com@gmail.com) and your translation will be bundled with the next version of the theme.


Useful links
------------

Please visit the following links to learn more about translating WordPress themes:

* http://codex.wordpress.org/Translating_WordPress
* http://codex.wordpress.org/Function_Reference/load_theme_textdomain

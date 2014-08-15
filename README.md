STE
===

STE stands for Simple Template Engine. It is intended to be secure, lightweight and fast.

Unlike some of the famous template engines (like Smarty, Twig, etc.) the template code is
not converted (compiled) to PHP code and then evaluated, but parsed on the fly. Variables and
blocks are replaced with regular expressions (preg_replace function). This approach has
several benefits (and drawbacks). The STE code is light (currently only one file), it is
fast (compared to PHP convert-ions), but most of all it is secure - you can give anyone to
make a HTML template for your project and it is safe to use since no PHP code can be
injected in a template files. And here comes the cons using this approach - all the logic
should be done in the PHP code and then passed to the template engine. STE does not recognize
even simplest if-then-else statements.



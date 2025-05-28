
# Aditional Packages

We need dompdf for PDF ticket reservation generation :
## $ composer require dompdf/dompdf

Animejs component for dynamic and modular animations :
## $ npm install animejs

Mandatory sass and ts loaders from Node packages :
## npm install typescript ts-loader@^9.0.0 --save-dev && npm install sass-loader sass webpack --save-dev

Mailer Component required for automated booking emails :
## composer require  symfony/mailer
## composer require symfony/mailtrap-mailer

### VERY IMPORTANT : comment the following line (l 24 of messenger.yaml) or emails from Mailer comp wont get through !
@echo off
git add .
git commit -m "HEROKU DEPLOYMENT"
git push origin master
git push heroku master
heroku open -a old-book-eshop

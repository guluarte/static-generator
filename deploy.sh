s3cmd sync --acl-public --guess-mime-type -P ./public/page/ab/* s3://funnythings247.com/page/ab/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ac/* s3://funnythings247.com/page/ac/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ad/* s3://funnythings247.com/page/ad/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ar/* s3://funnythings247.com/page/ar/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ch/* s3://funnythings247.com/page/ch/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ci/* s3://funnythings247.com/page/ci/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/co/* s3://funnythings247.com/page/co/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/da/* s3://funnythings247.com/page/da/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/de/* s3://funnythings247.com/page/de/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/do/* s3://funnythings247.com/page/do/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ev/* s3://funnythings247.com/page/ev/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/fr/* s3://funnythings247.com/page/fr/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/gi/* s3://funnythings247.com/page/gi/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/ho/* s3://funnythings247.com/page/ho/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/no/* s3://funnythings247.com/page/no/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/th/* s3://funnythings247.com/page/th/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/wh/* s3://funnythings247.com/page/wh/
s3cmd sync --acl-public --guess-mime-type -P ./public/page/zo/* s3://funnythings247.com/page/zo/
s3cmd sync --acl-public --guess-mime-type -P ./public/assets/* s3://funnythings247.com/assets/ --add-header 'Cache-Control: public, max-age=31600000' 
s3cmd sync --acl-public --guess-mime-type -P ./public/* s3://funnythings247.com/ --exclude='assets/*' --exclude='page/*'

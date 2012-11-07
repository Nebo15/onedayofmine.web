apt-get install sphinxsearch
cd /tmp
wget http://sphinxsearch.com/files/sphinx-2.0.6-release.tar.gz
tar -xzf sphinx-2.0.6-release.tar.gz
cd sphinx-2.0.6-release
cd ./api/libsphinxclient/
touch buildconf.sh
chmod +x buildconf.sh
./buildconf.sh
./configure
checkinstall
pecl install sphinx

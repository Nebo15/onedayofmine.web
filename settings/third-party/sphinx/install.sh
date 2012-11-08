PROJECT_DIR=$(realpath $(dirname $0)/../../../)

apt-get install sphinxsearch
mkdir -p /var/log/sphinx/searchd
mkdir -p /var/data/sphinx
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf days
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf users
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf days_delta
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf users_delta
chown -R sphinxsearch:sphinxsearch /var/log/sphinx/searchd
chown -R sphinxsearch:sphinxsearch /var/data/sphinx
echo "START=yes" > /etc/default/sphinxsearch
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

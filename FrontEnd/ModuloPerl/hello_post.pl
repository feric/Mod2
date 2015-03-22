#!/usr/bin/perl -w
use Switch;
use JSON qw( decode_json );
use LWP::UserAgent;

local ($buffer, @pairs, $pair, $name, $value, %FORM);
# Read in text
$ENV{'REQUEST_METHOD'} =~ tr/a-z/A-Z/;
if ($ENV{'REQUEST_METHOD'} eq "POST"){
   read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
}
else {
   $buffer = $ENV{'QUERY_STRING'};
}
# Split information into name/value pairs
@pairs = split(/&/, $buffer);
foreach $pair (@pairs)
{
   ($name, $value) = split(/=/, $pair);
   $value =~ tr/+/ /;
   $value =~ s/%(..)/pack("C", hex($1))/eg;
   $FORM{$name} = $value;
}
my $opcion = $FORM{numero};
my $server = "http://jsonplaceholder.typicode.com";

print "Content-type:text/html\r\n\r\n";
switch($opcion){
	case "1"	{peticion($server."/posts");}
	case "2"	{peticion($server."/users");}
	else		{peticion($server."/comments");}
}

# Subrutina que obtiene datos de un Web Services
sub peticion{
	my $ua = LWP::UserAgent->new;
	my $server_endpoint = $_[0];
	#my $server_endpoint = $server."/posts";
	
	# set custom HTTP request header fields
	my $req = HTTP::Request->new(GET => $server_endpoint);
	#$req->header('content-type' => 'text/html');
	$req->header('Content-type' => 'application/json');
	my $resp = $ua->request($req);
	if ($resp->is_success) {
		my $message =$resp->decoded_content;
		print "$message";
	}
	else {
		print "HTTP GET error code: ", $resp->code, "\n";
		print "HTTP GET error message: ", $resp->message, "\n";
	}
}

//Autor: Esau Reyes Valdespino

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Facebook;
using System.Configuration;
using System.Text.RegularExpressions;
using System.Dynamic;

namespace webSegura
{
    public partial class Form1 : Form
    {        
        private const string AppId = "353648331509583";
        private Uri _loginUrl;
        private const string _ExtendedPermissions = "user_about_me,publish_stream,offline_access";
        FacebookClient fbClient = new FacebookClient();         
        
        public Form1()
        {
            InitializeComponent();
        }

        public void Login()
        {
            dynamic parameters = new ExpandoObject();
            parameters.client_id = AppId;
            parameters.redirect_uri = "https://45.55.135.203:23456/Saludos/Drupal";
            parameters.response_type = "token";
            parameters.display = "popup";

            if (!string.IsNullOrWhiteSpace(_ExtendedPermissions))
                parameters.scope = _ExtendedPermissions;

            var fb = new FacebookClient();
            _loginUrl = fb.GetLoginUrl(parameters);

            webBrowser1.Navigate(_loginUrl.AbsoluteUri);            
        }

        private void Form1_Load_1(object sender, EventArgs e)
        {
            Login();
        }

        private void webBrowser1_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {
        }
    }
}

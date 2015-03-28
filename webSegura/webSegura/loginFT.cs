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

namespace webSegura
{
    public partial class loginFT : Form
    {
        public loginFT()
        {
            InitializeComponent();
        }

        private void loginFT_Load(object sender, EventArgs e)
        {
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form1 logF = new Form1();
            logF.Show();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form2 logT = new Form2();
            logT.Show();
        }
    }
}
